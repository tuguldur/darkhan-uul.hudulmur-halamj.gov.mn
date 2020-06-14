<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'APP_PATH' => '', //this value used for app root path -- /deps/zavkhan
    'DOC_ROOT_PATH' => $_SERVER['DOCUMENT_ROOT'],
    'SAME_RELATION_ORGS' => [
        'ХХҮЕГ' => 'http://www.hudulmur-halamj.gov.mn',
        'Архангай' => 'http://www.arkhangai.hudulmur-halamj.gov.mn',
        'Баян-Өлгий' => 'http://www.bayan-olgii.hudulmur-halamj.gov.mn',
        'Баянхонгор' => 'http://www.bayankhongor.hudulmur-halamj.gov.mn',
        'Булган' => 'http://www.bulgan.hudulmur-halamj.gov.mn',
        'Говь-Алтай' => 'http://www.govi-altai.hudulmur-halamj.gov.mn',
        'Говьсүмбэр' => 'http://govisumber.hudulmur-halamj.gov.mn',
        'Дархан-Уул' => 'http://darkhan-uul.hudulmur-halamj.gov.mn',
        'Дорноговь' => 'http://dornogovi.hudulmur-halamj.gov.mn',
        'Дорнод' => 'http://dornod.hudulmur-halamj.gov.mn',
        'Дундговь' => 'http://dundgovi.hudulmur-halamj.gov.mn',
        'Завхан' => 'http://zavkhan.hudulmur-halamj.gov.mn',
        'Орхон' => 'http://orkhon.hudulmur-halamj.gov.mn',
        'Өвөрхангай' => 'http://ovorkhangai.hudulmur-halamj.gov.mn',
        'Өмнөговь' => 'http://omnogovi.hudulmur-halamj.gov.mn',
        'Сүхбаатар' => 'http://sukhbaatar.hudulmur-halamj.gov.mn',
        'Сэлэнгэ' => 'http://selenge.hudulmur-halamj.gov.mn',
        'Төв' => 'http://tov.hudulmur-halamj.gov.mn',
        'Увс' => 'http://uvs.hudulmur-halamj.gov.mn',
        'Ховд' => 'http://khovd.hudulmur-halamj.gov.mn',
        'Хөвсгөл' => 'http://khovsgol.hudulmur-halamj.gov.mn',
        'Хэнтий' => 'http://khentii.hudulmur-halamj.gov.mn',
        'Нийслэл НХГ' => 'http://ub.hudulmur-halamj.gov.mn',
        'Багануур' => 'http://baganuur.hudulmur-halamj.gov.mn',
        'Багахангай' => 'http://bagahangai.hudulmur-halamj.gov.mn',
        'Баянгол' => 'http://bgd.hudulmur-halamj.gov.mn',
        'Баянзүрх' => 'http://bayanzurh.hudulmur-halamj.gov.mn',
        'Налайх' => 'http://nalaih.hudulmur-halamj.gov.mn',
        'Сонгинохайрхан' => 'http://songinohairhan.hudulmur-halamj.gov.mn',
        'Сүхбаатар дүүрэг' => 'http://sbd.hudulmur-halamj.gov.mn',
        'Хан-Уул' => 'http://han-uul.hudulmur-halamj.gov.mn',
        'Чингэлтэй' => 'http://chingeltei.hudulmur-halamj.gov.mn',
    ],
    'SYS_FILE_PATH' => [
        'CONTENT_FILE_UPLOAD_PATH' => '/uploads/content_title/',
        'CONTENT_PDF_UPLOAD_PATH' => '/uploads/files/pdfs/',
        'EVENT_IMG_UPLOAD_PATH' => '/uploads/event/covers/',
        'PAGE_IMG_UPLOAD_PATH' => '/uploads/page/covers/',
        'ALBUM_COVER_IMG_UPLOAD_PATH' => '/uploads/album/covers/',
        'ALBUM_IMG_UPLOAD_PATH' => '/uploads/album/'
    ],
    'SYS_PUBLIC_PATH' => public_path() . "/",
    'SYS_PUBLIC_PATH_WITHOUT_SLASH' => public_path(),
    'SYS_BASE_PATH' => base_path() . "/",
    'JOB_SERVICE_PATH' => [
        'AIMAG_NIISLEL_JOBS_COUNT' => 'http://202.180.218.209/webservices/aimag-niislel-jobs-count.php',
        'SECTOR_JOBS' => 'http://202.180.218.209/webservices/sectors-jobs-v2.php/?sectorId=',
        'OPENS-JOBS-AIMAG-NIISLEL' => 'http://202.180.218.209/webservices/opens-jobs-aimag-niislel-v2.php/?aimagNiislelId='
    ]
];
