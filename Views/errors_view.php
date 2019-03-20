<?php

class errors_view extends view {

    public function index() {

        $this->setTitle('Not found');

    }

    public function access_denied() {

        $this->setTitle('Odmowa dostępu');

    }

}