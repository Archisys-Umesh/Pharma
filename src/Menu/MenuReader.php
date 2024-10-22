<?php declare(strict_types = 1);

namespace App\Menu;

interface MenuReader
{
	public function writeMenu($routes);
        public function readMenu();
        public function setMenu($menu);
                
}
