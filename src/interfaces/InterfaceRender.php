<?php

namespace Src\interfaces;

interface InterfaceRender {

    public function setDir($Dir);

    public function setTitle($Title);

    public function setDescription($Description);

    public function renderLayout();

    public function pageRender();
}
