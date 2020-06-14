<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\MysqliDb;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function testMenuPostsPagination($currentPage = 1) {
        if (strlen($currentPage) > 4) {
            $currentPage = substr($currentPage, 0, 4);
        }
        if (!is_numeric($currentPage)) {
            return "Wrong page pagination param!.";
        }

        $itemsOnPerPage = 15;
        $x = 1;
        $range = 3;
        $offSet = ($currentPage - 1) * $itemsOnPerPage;

        $this->dbMan->where("menu_id", 17);
        $users = $this->dbMan->withTotalCount()->get('content', Array($offSet, $itemsOnPerPage));
        $totalPages = ceil($this->dbMan->totalCount / $itemsOnPerPage);

        foreach ($users as $key => $user) {
            echo($user['id'] . " - " . $user['title'] . "<br/>");
        }

        echo("<ul>");
        if ($currentPage > 1) {
            $prevpage = $currentPage - 1;
            echo " <li><a class='prev' href='/test/content/pagination/page/1/'> < </a></li> ";
            echo " <li><a class='prev' href='/test/content/pagination/page/$prevpage/'> << </a></li> ";
        }

        for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
            if (($x > 0) && ($x <= $totalPages)) {
                if ($x == $currentPage) {
                    echo " <li><a class='active'>$x</a></li> ";
                } else {
                    echo " <li><a href='/test/content/pagination/page/{$x}/'>$x</a></li> ";
                }
            }
        }

        if ($currentPage != $totalPages) {
            $nextpage = $currentPage + 1;
            echo " <li><a class='prev' href='/test/content/pagination/page/$nextpage/'> > </a></li> ";
            echo " <li><a class='prev' href='/test/content/pagination/page/$totalPages/'> >> </a></li> ";
        }
        echo("</ul>");

        echo "Showing {$itemsOnPerPage} from {$this->dbMan->totalCount}<br/>";
        //echo $this->dbMan->totalCount / $countPosts;
    }

}
