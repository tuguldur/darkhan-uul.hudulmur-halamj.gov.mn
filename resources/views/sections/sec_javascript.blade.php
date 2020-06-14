
@if ($type === '01')

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".main-header"><span class="icon fa fa-long-arrow-up"></span></div>

<script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script> 
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.fancybox.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.fancybox-media.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/owl.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/appear.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/wow.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/pgwslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/responsive-calendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.mousewheel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.mCustomScrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery-phone-mask.js') }}"></script>

<script type="text/javascript" src="{{ asset('/js/jquery.marquee.min.1.4.0.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.pause.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/pnotify.custom.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/plugins/ammap/ammap.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/ammap/maps/js/mongoliaHigh.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/ammap/dataloader/dataloader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/ammap/themes/dark.js?ver=20171012-02') }}"></script>	

<script type="text/javascript">
$(document).ready(function () {
    $('.pgwSlider').pgwSlider({maxHeight: 470});
    var topMarqueeWidth = $("#topMarqueeWidth").width();
    $('.top-text-ads-marquee').css("width", topMarqueeWidth);
    $('.top-text-ads-marquee').marquee({
        pauseOnHover: true,
        duration: 15000
    });
});

$(document).ready(function () {
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var year = currentTime.getFullYear();

    $.ajax({
        method: "GET",
        url: "/service/load/calendar-dates",
        data: {whatday: "nice"}
    }).done(function (callBackData) {
        //alert("Data Saved: " + callBackData);
        var parsedJsonBackData = JSON.parse(callBackData);
        $(".responsive-calendar").responsiveCalendar({
            time: year + '-' + month,
            events: parsedJsonBackData
        });

        //$('span[id="a"]');
        /*
         $("a[id='jobOfferCalendarDayID']").on("click", function () {
         alert("sdfsdfsdfj");
         });
         */
    }).fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    }).always(function () {
        //alert("complete");
    });

    $("#footerSubsidiaryOrganizations").mCustomScrollbar({
        scrollButtons: {
            enable: true
        },
        theme: "dark"
    });
    $("#postContentScroll01").mCustomScrollbar({
        scrollButtons: {
            enable: true
        },
        theme: "dark"
    });
    $("#postContentScroll02").mCustomScrollbar({
        scrollButtons: {
            enable: true
        },
        theme: "dark"
    });
    $("#postContentScroll03").mCustomScrollbar({
        scrollButtons: {
            enable: true
        },
        theme: "dark"
    });
});

function validateContactForm(thisForm) {
    var registerRegex = /^[АБВГДЕЁЖЗИЙКЛМНОӨПРСТУҮФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмноөпрстуүфхцчшщъыьэюя]{2}[0-9]{8}$/g;
    var isFormValid = true;
    var personName = $("#contactPersonName").val();
    var personCompText = $("#contactPersonText").val();
    var personRegister = $("#contactPersonRegister").val();

    personName = personName.replace(/\s+/, "");
    //personPhone = personPhone.replace(/\s+/, "");
    personCompText = personCompText.replace(/\s+/, "");

    if (personName.length < 3) {
        alert("Санал, хүсэлт өгөх хүний нэр буруу бичигдсэн байна.");
        isFormValid = false;
    }
    if (personCompText.length < 5) {
        alert("Санал, хүсэлт агуулга буруу бичигдсэн байна.");
        isFormValid = false;
    }
    if (!registerRegex.test(personRegister)) {
        alert("Санал, хүсэлт өгөх хүний регистр буруу бичигдсэн байна.");
        isFormValid = false;
    }

    return isFormValid;
}
function validateSearchForm(thisForm) {
    var isFormValid = true;
    var searchValueText = $("#searchTextInputId").val();
    searchValueText = searchValueText.replace(/\s+/, "");
    if (searchValueText.length < 3) {
        //alert("Хайх түлхүүр үг буруу байна.");
        isFormValid = false;
    }
    return isFormValid;
}
$(document).ready(function () {
    $('.dropdown-toggle-link-clickable').on('click', function () {
        self.location = $(this).attr('href');
    });

    $(function () {
        $("#contactPersonPhone").mask("9999-9999");
        $("#contactPersonPhone").on("blur", function () {
            var last = $(this).val().substr($(this).val().indexOf("-") + 1);
            if (last.length === 5) {
                var move = $(this).val().substr($(this).val().indexOf("-") + 1, 1);
                var lastfour = last.substr(1, 4);
                var first = $(this).val().substr(0, 9);
                $(this).val(first + move + '-' + lastfour);
            }
        });
    });
});
</script>

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif