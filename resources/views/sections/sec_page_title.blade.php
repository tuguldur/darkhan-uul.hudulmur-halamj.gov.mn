
@if ($type === '01')
<section class="page-title">
    <div class="auto-container">
        <div >
            <h4>{!! printMenuItemsPageTitle($menuID) !!}</h4>
        </div>
    </div>
</section>
@elseif ($type === '02')

Include section second

@elseif ($type === 'search_page')

<section class="page-title">
    <div class="auto-container">
        <div style="background: #fff;padding: 10px 0;">
            <h4>хайлтын үр дүн</h4>
        </div>
    </div>
</section>

@elseif ($type === 'contact_organization')

<section class="page-title">
    <div class="auto-container">
        <div>
            <h4>Манай байгууллагатай холбоо барих арга хэлбэрүүд</h4>
        </div>
    </div>
</section>

@elseif ($type === 'active_jobs_list')

<section class="page-title">
    <div class="auto-container">
        <div style="background: #fff;padding: 10px 0;">
            <h4>Нээлттэй ажлын байрны жагсаалт</h4>
        </div>
    </div>
</section>

@else

Include section anything

@endif