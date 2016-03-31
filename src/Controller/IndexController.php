<?php
namespace Controller;

use Doctrine\DBAL\Query\QueryBuilder;

class IndexController
{
    public function indexAction()
    {
        include("search.php");
    }
}