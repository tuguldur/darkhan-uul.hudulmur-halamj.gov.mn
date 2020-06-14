
@if ($type === '01')

<!--Sponsors Section-->
<section class="sponsors-section">
    <div class="auto-container">
        <div class="sponsors-outer page-part-style" style="background: #0156A9; padding: 10px;">
            <ul class="sponsors-carousel owl-carousel owl-theme">
                {!! printRelatedLinks() !!}
            </ul>
        </div>
    </div>
</section>
<!--End Sponsors Section-->

@elseif ($type === '02')


@else

Include section anything

@endif