<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Http\Request;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FileManController;
use App\Http\Controllers\ComplaintController;

//---------------Helper Functions For Administrator---------------
function sayHello() {
    $menuController = new MenuController();
    return $menuController->sayHelloMenuFunction();
}

function printFileRRR() {
    $fileController = new FileManController();
    $rootPath = public_path() . "/uploads";
    return $fileController->readFoldersTree($rootPath);
}

function printCalendarEventsTable() {
    $calendarController = new CalendarController();
    return $calendarController->getCalendarEventsTable();
}

function printLatestGalleryImages() {
    $albumController = new AlbumController();
    return $albumController->getLatestGalleryImages();
}

function printHomeHeaderMenuTree() {
    $menuController = new MenuController();
    return $menuController->printHomeHeaderMenuTree();
}

function printMenuItems($menuId, $pageIndex) {
    //$menuSlugDetailView = substr($menuDetailUrlPath, (strripos($menuDetailUrlPath, "/") + 1));
    $menuController = new MenuController();
    return $menuController->getPrintMenuItemsHTML($menuId, $pageIndex);
}

function printMenuItemPost($postDetailUrlPath) {
    $postSlugDetailView = substr($postDetailUrlPath, (strripos($postDetailUrlPath, "/") + 1));
    $postController = new PostController();
    return $postController->getMenuItemPost($postSlugDetailView);
}

function printUpcomingEvents() {
    $eventController = new EventController();
    return $eventController->getUpcomingEvents();
}

function printEventOgTags($eventID) {
    $eventController = new EventController();
    return $eventController->getEventOgTags($eventID);
}

function printFrontFourSlider() {
    $postController = new PostController();
    return $postController->getFrontFourSlider();
}

function printNullMenuIDTableByHTML() {
    $postController = new PostController();
    return $postController->geNullMenuIDTableByHTML();
}

function printFrontFAQsHTML() {
    $postController = new PostController();
    return $postController->getFrontFAQsHTML();
}

function printReadFAQDetails($faqID) {
    $postController = new PostController();
    return $postController->getReadFAQDetails($faqID);
}

function printFrontMostReadContentHTML() {
    $postController = new PostController();
    return $postController->getFrontMostReadContentHTML();
}

function printFrontLatestContentHTML() {
    $postController = new PostController();
    return $postController->getFrontLatestContentHTML();
}

function printLastThreeEvents() {
    $eventController = new EventController();
    return $eventController->getLastThreeEvents();
}

function printMenuSubMenus($menuDetailUrlPath) {
    $menuSlugDetailView = substr($menuDetailUrlPath, (strripos($menuDetailUrlPath, "/") + 1));
    $menuController = new MenuController();
    return $menuController->getMenuSubMenus($menuSlugDetailView);
}

function printBreadCrumbPath($menuId, $postId) {
    $menuController = new MenuController();
    return $menuController->getBreadCrumbPath($menuId, $postId);
}

function printMenuItemsPageTitle($menuID) {
    $menuController = new MenuController();
    return $menuController->getMenuItemsPageTitle($menuID);
}

function printSearchFoundItems($searchKeyValue, $currentPageIndex) {
    if (strlen($searchKeyValue) < 3 || strlen($searchKeyValue) > 40) {
        return "";
    }

    $postController = new PostController();
    return $postController->getSearchFoundItems($searchKeyValue, $currentPageIndex);
}

function printNewsMenuAdminPage() {
    $menuController = new MenuController();
    return $menuController->getNewsMenuAdminPage();
}

function printNewsMenuAdminPage02() {
    $menuController = new MenuController();
    return $menuController->getNewsMenuAdminPage02();
}

function printFAQsTable() {
    $faqController = new FAQController();
    return $faqController->getFAQsTable();
}

function printPageTable() {
    $pageController = new PageController();
    return $pageController->getPageTable();
}

function printFrontTwoPages() {
    $pageController = new PageController();
    return $pageController->getFrontTwoPages();
}

function printAlbumTable() {
    $albumController = new AlbumController();
    return $albumController->getAlbumTable();
}

function printAlbumsForEditManager() {
    $albumController = new AlbumController();
    return $albumController->getAlbumsForEditManager();
}

function printLinksTable() {
    $linkController = new LinkController();
    return $linkController->getLinksTable();
}

function printComplaintsRequestsTable() {
    $complaintController = new ComplaintController();
    return $complaintController->getComplaintsRequestsTable();
}

function printRelatedLinks() {
    $linkController = new LinkController();
    return $linkController->getRelatedLinks();
}

function printGeneralInfoFormElements() {
    $generalController = new GeneralController();
    return $generalController->getGeneralInfoFormElements();
}

function printEventsTableHTML() {
    $eventController = new EventController();
    return $eventController->getEventsTableHTML();
}

function printReadEventDetails($eventID) {
    $eventController = new EventController();
    return $eventController->getReadEventDetails($eventID);
}

function printIndexPageStatisticNumbers() {
    $statisticController = new StatisticController();
    return $statisticController->getIndexPageStatisticNumbers();
}

function printMarqueeTable() {
    $adsController = new AdvertisementController();
    return $adsController->getMarqueeTable();
}

function printHeaderMarqueeText() {
    $adsController = new AdvertisementController();
    return $adsController->getHeaderMarqueeText();
}
