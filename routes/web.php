<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get("/", function () {
    return view('welcome');
});

Route::get("/delete", function () {
    return view('delete');
});

Route::get('/menu/{menuID}/', function () {
    $segmentPostID = '';
    $segmentMenuID = Request::segment(2);
    $pageIndex = 1;
    return view('pages.page_menu_items')->with(['menuID' => $segmentMenuID, 'postID' => $segmentPostID, 'pageIndex' => $pageIndex]);
});

Route::get('/menu/{menuID}/page/{pageIndex}/', function () {
    $segmentPostID = '';
    $segmentMenuID = Request::segment(2);
    $pageIndex = Request::segment(4);
    return view('pages.page_menu_items')->with(['menuID' => $segmentMenuID, 'postID' => $segmentPostID, 'pageIndex' => $pageIndex]);
});

Route::get('/menu/{menuID}/post/{postID}/', function () {
    $segmentPostID = Request::segment(4);
    $segmentMenuID = Request::segment(2);

    return view('pages.page_menu_item_read')->with(['menuID' => $segmentMenuID, 'postID' => $segmentPostID]);
})->name('readPostByIdWithMenuID');

Route::post('/search', array('uses' => 'PostController@getFoundItemsBySearch'));
Route::any('/search/page/{currentPage}/', array('uses' => 'PostController@getFoundItemsBySearch'));

/*Route::post('/search/', function () {
    //print_r($_POST);
    //$segmentPostID = '';
    //$segmentMenuID = '';
    //return view('pages.page_search_items')->with(['menuID' => $segmentMenuID, 'postID' => $segmentPostID]);
});*/
/*
Route::any('/search/page/{currentPageIndex}/', function () {
    $segmentPostID = '';
    $segmentMenuID = '';
    $currentPageIndex = Request::segment(3);
    return view('pages.page_search_items')->with(['menuID' => $segmentMenuID, 'postID' => $segmentPostID, 'currentPageIndex' => $currentPageIndex]);
});*/

Route::post('/contact-form/submit', array('uses' => 'ComplaintController@insertComplaintFormData'));

Route::get('/event/{eventID}/', function () {
    $segEventID = '';
    $segEventID = Request::segment(2);
    return view('pages.page_event_item_read')->with(['eventID' => $segEventID]);
});

Route::get('/faq/{faqID}/', function () {
    $segEventID = '';
    $segEventID = Request::segment(2);
    return view('pages.page_faq_item_read')->with(['faqID' => $segEventID]);
});

Route::get('/page/{pageID}/', function () {
    $segPageID = '';
    $segPageID = Request::segment(2);
    return view('pages.page_page_item_read')->with(['pageID' => $segPageID]);
});

Route::get('/contact/', function () {
    return view('pages.page_contact_organization');
});

Route::get('/service/load/calendar-dates', array('uses' => 'CalendarController@loadCalendarDatesInJSON'));

Route::get('/view/province/active-jobs/{jobMapId}', array('uses' => 'JobController@loadActiveProvinceJobsInJSON'));
Route::get('/view/sector/active-jobs/{sectorId}', array('uses' => 'JobController@loadSectorActiveJobsInJSON'));
Route::get('/service/load/mongolia/active-jobs', array('uses' => 'JobController@loadActiveMongoliaJobsInJSON'));
Route::post('/service/update/menu-news/read-count', array('uses' => 'PostController@updateMenuNewsReadCountInJSON'));
Route::post('/service/update/welcome-page/visit-count', array('uses' => 'GeneralController@countWelcomePageVisitor'));

/*
  |-------------------------------- Test ------------------------------------------
 */
Route::get('/test/content/pagination/', array('uses' => 'TestController@testMenuPostsPagination'));
Route::get('/tool/content/title/images/{keyCodeId}/', array('uses' => 'ToolsController@resizeAllContentTitleImages'));
Route::get('/test/content/pagination/page/{pageIndex}/', array('uses' => 'TestController@testMenuPostsPagination'));
Route::get('/test/mail/send', array('uses' => 'MailController@sendTestEmail'));

/*
  |-------------------------------- Administrator ------------------------------------------
 */

Route::get('/administrator/', function () {
    return view('administrator.index')->with(['page_type' => 'index']);
});

Route::get('/administrator/news/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'news_manager']);
});
Route::get('/administrator/faq/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'faq_manager']);
});
Route::get('/administrator/link/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'link_manager']);
});
Route::get('/administrator/general-info/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'general_info_manager']);
});
Route::get('/administrator/event/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'event_manager']);
});
Route::get('/administrator/marquee/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'marquee_manager']);
});
Route::get('/administrator/page/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'page_manager']);
});
Route::get('/administrator/file-upload/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'file_upload_manager']);
});
Route::get('/administrator/gallery/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'gallery_manager']);
});
Route::get('/administrator/gallery/images/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'gallery_images_manager']);
});
Route::get('/administrator/calendar-event/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'calendar_event_manager']);
});
Route::get('/administrator/complaint-request/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'complaint_request_manager']);
});
Route::get('/administrator/menu/manager/', function () {
    return view('administrator.index')->with(['page_type' => 'menu_manager']);
});
Route::get('/administrator/menu/transfer', function () {
    return view('administrator.index')->with(['page_type' => 'menu_transfer']);
});
Route::get('/administrator/menu/new/', function () {
    return view('administrator.index')->with(['page_type' => 'new_menu_manager']);
});

/*
  |-------------------------------- Guideline ------------------------------------------
 */
Route::get('/administrator/guide/news_manager/', function () {
    return view('administrator.index')->with(['page_type' => 'guide_news_manager']);
});
Route::get('/administrator/guide/link_manager/', function () {
    return view('administrator.index')->with(['page_type' => 'link_news_manager']);
});
Route::get('/administrator/guide/general_info_manager/', function () {
    return view('administrator.index')->with(['page_type' => 'guide_general_info_manager']);
});
Route::get('/administrator/guide/marquee_info_manager/', function () {
    return view('administrator.index')->with(['page_type' => 'guide_marquee_info_manager']);
});
Route::get('/administrator/guide/edit_old_news_manager/', function () {
    return view('administrator.index')->with(['page_type' => 'guide_edit_old_news_manager']);
});
Route::get('/administrator/guide/edit_image_resize', function () {
    return view('administrator.index')->with(['page_type' => 'guide_edit_image_resize']);
});
Route::get('/administrator/guide/edit_none_responsive_image', function () {
    return view('administrator.index')->with(['page_type' => 'guide_edit_none_responsive_image']);
});
Route::get('/administrator/guide/event_manager', function () {
    return view('administrator.index')->with(['page_type' => 'guide_event_manager']);
});

/*
  |-------------------------------- Administrator DAO ------------------------------------------
 */
Route::post('/administrator/news/newsActionManagerDAO', array('uses' => 'PostController@actionNewsManagerDAO'));
Route::post('/administrator/faq/faqActionManagerDAO', array('uses' => 'FAQController@actionFaqManagerDAO'));
Route::post('/administrator/link/linkActionManagerDAO', array('uses' => 'LinkController@actionLinkManagerDAO'));
Route::post('/administrator/general-info/generalInfoActionManagerDAO', array('uses' => 'GeneralController@actionGeneralInfoManagerDAO'));
Route::post('/administrator/event/eventActionManagerDAO', array('uses' => 'EventController@actionEventManagerDAO'));
Route::post('/administrator/marquee/marqueeActionManagerDAO', array('uses' => 'AdvertisementController@actionMarqueeManagerDAO'));
Route::post('/administrator/page/pageActionManagerDAO', array('uses' => 'PageController@actionPageManagerDAO'));
Route::post('/administrator/album/albumActionManagerDAO', array('uses' => 'AlbumController@actionAlbumManagerDAO'));
Route::post('/administrator/album/images/upload', array('uses' => 'AlbumController@uploadActionAlbumImages'));
Route::post('/administrator/calendar-event/calendarEventActionManagerDAO', array('uses' => 'CalendarController@actionCalendarEventManagerDAO'));
Route::post('/administrator/menu/menuActionManagerDAO', array('uses' => 'MenuController@actionMenuManagerDAO'));
Route::post('/administrator/menu/menuActionTransfer', array('uses' => 'MenuController@actionMenuTransfer'));
Route::post('/administrator/file-upload/uploadActionFileManager', array('uses' => 'UploadController@uploadActionFileManager'));
Route::post('/administrator/complaint/complaintActionManagerDAO', array('uses' => 'ComplaintController@actionComplaintManagerDAO'));

/*
  |-------------------------------- Administrator Services ------------------------------------------
 */
Route::post('/administrator/service/menu/news/', array('uses' => 'PostController@getMenuNewsTableByHTML'));
Route::post('/administrator/service/menu/error-news/', array('uses' => 'PostController@getErrorMenuNewsTableByHTML'));
Route::post('/administrator/service/load/news/details/', array('uses' => 'PostController@loadNewsDetailsByID'));
Route::post('/administrator/service/load/faq/details/', array('uses' => 'FAQController@loadFaqDetailsByID'));
Route::post('/administrator/service/load/link/details/', array('uses' => 'LinkController@loadLinkDetailsByID'));
Route::post('/administrator/service/load/event/details/', array('uses' => 'EventController@loadEventDetailsByID'));
Route::post('/administrator/service/load/marquee/details/', array('uses' => 'AdvertisementController@loadAdvertisementDetailsByID'));
Route::post('/administrator/service/load/page/details/', array('uses' => 'PageController@loadPageDetailsByID'));
Route::post('/administrator/service/load/album/details/', array('uses' => 'AlbumController@loadAlbumDetailsByID'));
Route::post('/administrator/service/load/album/images/', array('uses' => 'AlbumController@loadAlbumImagesByAlbumID'));
Route::post('/administrator/service/load/calendar-event/details', array('uses' => 'CalendarController@loadCalendarEventDetailsByID'));
Route::post('/administrator/service/menu/sub-menus', array('uses' => 'MenuController@getSubMenusTableByHTML'));
Route::post('/administrator/service/load/menu/sub-menus/ordering', array('uses' => 'MenuController@getSubMenusForOrdering'));
Route::post('/administrator/service/load/menu/details', array('uses' => 'MenuController@loadMenuDetailsByID'));
Route::post('/administrator/service/menu/details', array('uses' => 'MenuController@loadMenuDetailsByID'));
Route::post('/administrator/service/load/complaint/details', array('uses' => 'ComplaintController@loadComplaintDetailsByID'));
Route::post('/administrator/service/update/menu/ordering', array('uses' => 'MenuController@updateMenuOrderingByIDs'));

/*
  |-------------------------------- Administrator Delete Services ------------------------------------------
 */
Route::post('/administrator/service/delete/event', array('uses' => 'EventController@deleteEventByID'));
Route::post('/administrator/service/delete/album/image', array('uses' => 'AlbumController@deleteAlbumImageByID'));
Route::post('/administrator/service/delete/news', array('uses' => 'PostController@deleteNewsByID'));
Route::post('/administrator/service/delete/menu', array('uses' => 'MenuController@deleteMenuByID'));
Route::post('/administrator/service/delete/complaint', array('uses' => 'ComplaintController@deleteComplaintByID'));

Auth::routes();

//Route::get('/administrator/home', 'HomeController@index')->name('home');
Route::get('/administrator/', 'HomeController@index')->name('administrator_home');

Route::get('db_dump', function () {
    /*
    Needed in SQL File:

    SET GLOBAL sql_mode = '';
    SET SESSION sql_mode = '';
    */
    $get_all_table_query = "SHOW TABLES";
    $result = DB::select(DB::raw($get_all_table_query));

    $tables = [
        'users',
        "advertisements",
        "album",
        "album_images",
        "banner",
        "calendar_dates",
        "complain_solved",
        "complaint",
        "content",
        "counter_ips",
        "counter_values",
        "events",
        "faq",
        "general_info",
        "link",
        "menu",
        "migration",
        "old_content",
        "pages",
        "user"
    ];

    $structure = '';
    $data = '';
    foreach ($tables as $table) {
        $show_table_query = "SHOW CREATE TABLE " . $table . "";

        $show_table_result = DB::select(DB::raw($show_table_query));

        foreach ($show_table_result as $show_table_row) {
            $show_table_row = (array)$show_table_row;
            $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
        }
        $select_query = "SELECT * FROM " . $table;
        $records = DB::select(DB::raw($select_query));

        foreach ($records as $record) {
            $record = (array)$record;
            $table_column_array = array_keys($record);
            foreach ($table_column_array as $key => $name) {
                $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
            }

            $table_value_array = array_values($record);
            $data .= "\nINSERT INTO $table (";

            $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";

            foreach($table_value_array as $key => $record_column)
                $table_value_array[$key] = addslashes($record_column);

            $data .= "('" . implode("','", $table_value_array) . "');\n";
        }
    }
    $file_name = __DIR__ . '/../database/database_backup_on_' . date('y_m_d') . '.sql';
    $file_handle = fopen($file_name, 'w + ');

    $output = $structure . $data;
    fwrite($file_handle, $output);
    fclose($file_handle);
    echo "DB backup ready";
});