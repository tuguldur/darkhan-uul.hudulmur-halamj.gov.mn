
@if ($type === '01')

{!! printBreadCrumbPath($menuID, $postID) !!}

<!--
<section class="page-info">
    <div class="auto-container clearfix">
        <div class="pull-left">
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Blog</li>
            </ul>
        </div>

    </div>
</section>
-->
@elseif ($type === '02')


@else

Include section anything

@endif