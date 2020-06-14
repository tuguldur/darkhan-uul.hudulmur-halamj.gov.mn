
@if ($page_type === 'index')

@include('administrator.pages.page_admin_index', ['type' => '01'])

@elseif ($page_type === 'form')

@include('administrator.pages.page_admin_form', ['type' => '01'])

@elseif ($page_type === 'news_manager')

@include('administrator.pages.page_admin_news_manager', ['type' => '01'])

@elseif ($page_type === 'faq_manager')

@include('administrator.pages.page_admin_faq_manager', ['type' => '01'])

@elseif ($page_type === 'link_manager')

@include('administrator.pages.page_admin_link_manager', ['type' => '01'])

@elseif ($page_type === 'general_info_manager')

@include('administrator.pages.page_admin_general_info_manager', ['type' => '01'])

@elseif ($page_type === 'event_manager')

@include('administrator.pages.page_admin_event_manager', ['type' => '01'])

@elseif ($page_type === 'marquee_manager')

@include('administrator.pages.page_admin_marquee_manager', ['type' => '01'])

@elseif ($page_type === 'page_manager')

@include('administrator.pages.page_admin_page_manager', ['type' => '01'])

@elseif ($page_type === 'gallery_manager')

@include('administrator.pages.page_admin_gallery_manager', ['type' => '01'])

@elseif ($page_type === 'gallery_images_manager')

@include('administrator.pages.page_admin_gallery_images_manager', ['type' => '01'])

@elseif ($page_type === 'calendar_event_manager')

@include('administrator.pages.page_admin_calendar_event_manager', ['type' => '01'])

@elseif ($page_type === 'complaint_request_manager')

@include('administrator.pages.page_admin_complaint_request_manager', ['type' => '01'])

@elseif ($page_type === 'guide_news_manager')

@include('administrator.guides.page_guide_news_manager', ['type' => '01'])

@elseif ($page_type === 'link_news_manager')

@include('administrator.guides.page_guide_link_manager', ['type' => '01'])

@elseif ($page_type === 'menu_manager')

@include('administrator.pages.page_admin_menu_manager', ['type' => '01'])

@elseif ($page_type === 'menu_transfer')

@include('administrator.pages.page_admin_menu_transfer', ['type' => '01'])

@elseif ($page_type === 'new_menu_manager')

@include('administrator.pages.page_admin_new_menu_manager', ['type' => '01'])

@elseif ($page_type === 'file_upload_manager')

@include('administrator.pages.page_admin_file_upload_manager', ['type' => '01'])

@elseif ($page_type === 'guide_general_info_manager')

@include('administrator.guides.page_guide_general_info_manager', ['type' => '01'])

@elseif ($page_type === 'guide_marquee_info_manager')

@include('administrator.guides.page_guide_marquee_info_manager', ['type' => '01'])

@elseif ($page_type === 'guide_edit_old_news_manager')

@include('administrator.guides.page_guide_edit_old_news_manager', ['type' => '01'])

@elseif ($page_type === 'guide_edit_image_resize')

@include('administrator.guides.page_guide_edit_image_resize', ['type' => '01'])

@elseif ($page_type === 'guide_edit_none_responsive_image')

@include('administrator.guides.page_guide_edit_none_responsive_image', ['type' => '01'])

@elseif ($page_type === 'guide_event_manager')

@include('administrator.guides.page_guide_event_manager', ['type' => '01'])

@else

Include section anything

@endif
