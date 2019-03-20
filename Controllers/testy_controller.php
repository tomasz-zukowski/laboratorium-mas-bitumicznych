<?php
class testy_controller extends controller {

    public function test() {

        $View = $this->loadView();
        $View -> render('informacje');

    }

}