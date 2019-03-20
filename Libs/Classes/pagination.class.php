<?php

class pagination {

    private $limit = 15; /** @var int > 0  */
    //private $active = 1;
    private $shared;
    private $results_num;

    public function __construct($array) {

        try
        {
            if(is_array($array) && !is_null($array))
            {
                /** sprawdzam czy tablica jest wielowymiarowa czy jednowymiarowa */
                if(isset($array[0]))
                {
                    $results = $array;
                }
                else
                {
                    $results[] = $array;
                }

                $this->share($results);
            }
            else
            {
                throw new Exception('Parametr musi być tablicą');
            }
        }
        catch(Exception $e)
        {
            //echo $e->getMessage();
            return false;
        }
    }

    /**
     * Dzieli tablicę wyników na części odpowiadające stronom paginacji
     * @param $results
     * @return array
     */
    private function share($results) {

        if(!is_null($results) && is_array($results))
        {
            $shared = array_chunk($results,$this->limit);

            if(!empty($shared))
            {
                $this->shared = $shared;
                $this->results_num = count($shared);
            }
        }
    }

    /**
     * sprawdzanie czy tablica po podziale bedzie miala taka strone jaka wolamy
     * @param int $page
     * @return bool
     */
    public function hasPage($page=1) {

        if(isset($this->shared[$page]))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Pobieranie strony jeżeli istnieje to zwraca strone z shared
     * jeżeli nie to zwraca ostatnią stronę z shared (jako że jest tablicą to -1)
     * @param int $page
     * @return mixed
     * @throws Exception
     */
    public function getPage($page=1) {

        if($page>0)
        {
            /** Wyznaczenie aktywnej zakladki */
            $this->active = $page;

            if($this->hasPage($page-1))
            {
                return $this->shared[$page-1];
            }
            else
            {
                $this->active = $this->checkNum($this->shared);
                return $this->shared[$this->checkNum($this->shared)-1];
            }
        }

    }

    /**
     * @param $array
     * @return bool|int
     */
    private function checkNum($array)
    {
        try
        {
            if(!is_null($array) && is_array($array))
            {
                return count($array);
            }
            else
            {
                throw new Exception('Parametr musi być tablicą');
            }
        }
        catch(Exception $e)
        {
            //echo $e->getMessage();
            return false;
        }
    }

    /**
     * Drukowanie elementu paginacja na stronie
     */
    public function render() {

        $pgn_block    = '';
        $left_class   = '';
        $right_class  = '';
        $pgn_previous = '';
        $pgn_next     = '';

        if(!is_null($this->shared) && !is_null($this->shared) && is_array($this->shared))
        {
            if($this->active<=1)
            {
                $left_class = 'disabled';
                $pgn_previous = '1';
            }
            else
            {
                $pgn_previous = $this->active-1;
            }

            if($this->active==$this->results_num)
            {
                $right_class = 'disabled';
                $pgn_next = $this->results_num;
            }
            else
            {
                $pgn_next = $this->active+1;
            }

            $pgn_block .= '<ul class="pagination" style="margin: 0px 10px;">';
            $pgn_block .= '<li class="'.$left_class.'"><a href="?pgn_start='.$pgn_previous.'">&laquo;</a></li>';

            for($i=0;$i<$this->results_num;$i++)
            {
                $active_class = '';
                $pgn_counter = ($i+1);

                if($pgn_counter==$this->active)
                {
                    $active_class = 'active';
                }

                $pgn_block .= '<li class="'.$active_class.'"><a href="?pgn_start='.$pgn_counter.'">'.$pgn_counter.'</a></li>';
            }

            $pgn_block .= '<li class="'.$right_class.'"><a href="?pgn_start='.$pgn_next.'">&raquo;</a></li>';
            $pgn_block .= '</ul>';
        }
        return $pgn_block;
    }
} 