<script type="text/javascript">

    function ValidURL(strUrl) {
        var validUrlRegex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
        if (!validUrlRegex.test(strUrl)) {
            //alert("Please enter valid URL.");
            return false;
        } else {
            return true;
        }
    }
</script>
@if ($page_type === 'index')

@elseif ($page_type === 'form')

@elseif ($page_type === 'file_upload_manager')

<script type="text/javascript">
    $(document).ready(function () {
        $("a#uploadFileTreeA").click(function () {
            $("a#uploadFileTreeA").css({"background": "#fff", "color": "inherit", "padding": "3px", "border-radius": "3px"});
            $("#fileUploadPath").val($(this).data("folderpath"));
            $(this).css({"background": "#238ED9", "color": "#fff", "padding": "3px", "border-radius": "3px"});
        });
    });

    function validateUploadFileForm(thisForm) {
        var isDataValid = true;

        if ($("#fileUploadPath").val().length < 4) {
            isDataValid = false;
            alert("Файл хуулах замаа сонгоогүй байна.");
        }

        if ($("#choosenFileToBeUpload").val().length < 4) {
            isDataValid = false;
            alert("Хуулах Файл сонгоогүй байна.");
        }

        return isDataValid;
    }
</script>

@elseif ($page_type === 'calendar_event_manager')

<script type="text/javascript">
    function editThisCalendarEvent(thisElement) {
        var $this = $(thisElement);
        var selectedCalEventID = $this.data("caleventid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/calendar-event/details",
            data: {dataSwitch: "LCEE0367", selectedCalEventID: selectedCalEventID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#calEventID").val(value1);
                        $("#calEventActionCodeHidden").val(value1);
                        break;
                    case "cal_title":
                        $("#calEventTitle").val(value1);
                        break;
                    case "cal_date":
                        $("#single_cal2").val(value1);
                        break;
                    case "cal_url":
                        $("#calEventURL").val(value1);
                        break;
                    case "cal_type":
                        $("#calEventType>option[value='" + value1 + "']").prop("selected", true);
                        break;
                    case "cal_active":
                        if (value1 === 1) {
                            $("input[name='calEventActiveStatus'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='calEventActiveStatus'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#calEventActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#calEventManagerSaveBtn").removeAttr("disabled");
            $("#calEventActionTypeHidden").val("edit");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }
</script>

@elseif ($page_type === 'gallery_manager')

<script type="text/javascript">

    function editThisAlbum(thisElement) {
        var $this = $(thisElement);
        var selectedAlbumID = $this.data("albumid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/album/details",
            data: {dataSwitch: "LACE9964", selectedAlbumID: selectedAlbumID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#albumID").val(value1);
                        $("#albumActionCodeHidden").val(value1);
                        break;
                    case "name":
                        $("#albumTitle").val(value1);
                        break;
                    case "date":
                        $("#single_cal2").val(value1);
                        break;
                    case "cover_image":
                        $("#albumCoverImage").attr("src", "/uploads/album/covers/" + value1);
                        $("#albumCoverImageNameHidden").val(value1);
                        break;
                    case "description":
                        $("#albumContent").val(value1);
                        break;
                    case "active":
                        if (value1 === 1) {
                            $("input[name='albumActiveStatus'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='albumActiveStatus'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#albumActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#albumManagerSaveBtn").removeAttr("disabled");
            $("#albumActionTypeHidden").val("edit");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }

    function validateAlbumForm(thisForm) {
        var isThisFormValid = true;

        if ($("#albumTitle").val().length < 4) {
            isThisFormValid = false;
            alert("Цомгийн нэрийг буруу өгсөн байна. Эсвэл цөөхөн үсэг бичсэн байна.");
        }

        if ($("#albumCoverImageFile").val().length < 5) {
            isThisFormValid = false;
            alert("Цомгийн нүүр зураг сонгоогүй байна.");
        }

        if ($("#albumActionTypeHidden").val() === "edit" && $("#albumActionCodeHidden").val() === "") {
            isThisFormValid = false;
            alert("Зургийн цомог засах түрхүүр дугаар буруу байна. засах боломжгүй.");
        }

        return isThisFormValid;
    }
</script>

@elseif ($page_type === 'gallery_images_manager')

<script type="text/javascript">
    var fileInputElementsCount = 1;

    function addMoreOneInputFileElement(thisElement) {
        fileInputElementsCount++;
        var albumImagesInputContainer = $("#albumImagesInputContainer");

        if (fileInputElementsCount < 6) {
            albumImagesInputContainer.append("<div class='form-group'>" +
                    "<label for='albumImage" + fileInputElementsCount + "' class='control-label col-md-3 col-sm-3 col-xs-12'>Цомогт оруулах зураг-" + fileInputElementsCount + ": </label>" +
                    "<div class='col-md-6 col-sm-6 col-xs-12'>" +
                    "<input type='file' id='albumImage" + fileInputElementsCount + "' accept='image/*' name='albumImage" + fileInputElementsCount + "' class='form-control col-md-7 col-xs-12'>" +
                    "</div>" +
                    "</div>");
        }
    }

    function validateUploadAlbumImagesForm(thisForm) {
        var isDataValid = true;
        var selectedAlbumId = $("#imagesAlbum").children("option").filter(":selected").val();

        if (selectedAlbumId === "none") {
            alert("Зураг оруулах зургийн цомог сонгоно уу.");
            isDataValid = false;
        }

        return isDataValid;
    }

    function deleteThisAlbumImage(thisElement) {
        var $this = $(thisElement);
        var selectedImageID = $this.data("imageid");

        $this.closest("div.thumbnail").css("border", "3px solid red");
        var userResultDecision = confirm("энэ зургийг устгах уу?");
        if (userResultDecision === true) {
            $.ajax({
                method: "POST",
                url: "/administrator/service/delete/album/image",
                data: {dataSwitch: "DAIC6548", selectedImageID: selectedImageID, "_token": "{{ csrf_token() }}"}
            }).done(function (callBackData) {
                //alert("Data Saved: " + callBackData);
                if (callBackData === "yes") {
                    $this.closest("div.col-md-55").css("background", "red").remove();
                } else {
                    alert("Зураг устгах үед алдаа гарсан тул зураг устгагдаагүй !");
                }

                //$("#menuNewsTableContainer").html(callBackData);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        } else {
            $this.closest("div.thumbnail").css("border", "1px solid #ddd");
            return false;
        }
    }

    function loadThisAlbumImages(thisElement) {
        var $this = $(thisElement);

        var selectedValueOption = $this.children("option").filter(":selected").val();

        if (selectedValueOption !== "none") {
            $("#albumImagesContainingEditor").html("");
            $.ajax({
                method: "POST",
                url: "/administrator/service/load/album/images",
                data: {dataSwitch: "LAIE7761", selectedValueOption: selectedValueOption, "_token": "{{ csrf_token() }}"}
            }).done(function (callBackData) {
                //alert("Data Saved: " + callBackData);
                msgJSON = JSON.parse(callBackData);
                $.each(msgJSON, function (key1, value1) {
                    $("#albumImagesContainingEditor").append("<div class='col-md-55'>" +
                            "<div class='thumbnail'>" +
                            "<div class='image view view-first'>" +
                            "<img style='width: 100%; display: block;' src='/uploads/album/" + value1['file_name'] + "' alt='image' />" +
                            "<div class='mask'>" +
                            "<p>Your Text</p>" +
                            "<div class='tools tools-bottom'>" +
                            "<a href='#'><i class='fa fa-link'></i></a>" +
                            "<a href='#'><i class='fa fa-pencil'></i></a>" +
                            "<a onclick='deleteThisAlbumImage(this);' data-imageid='" + value1['id'] + "'><i class='fa fa-times'></i></a>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='caption'>" +
                            "<p>" + value1['file_uploaded_at'] + "</p>" +
                            "</div>" +
                            "</div>" +
                            "</div>");
                });
                $("#newsManagerSaveBtn").removeAttr("disabled");
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });

        }
    }
</script>

@elseif ($page_type === 'new_menu_manager')

<script type="text/javascript">
    $(document).ready(function () {
        $('#newsMenuTree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });
        $('#newsMenuTree').on("changed.jstree", function (e, data) {
            //alert(data.selected);
            var i, j, r = [];
            var selectedMenuID;
            for (i = 0, j = data.selected.length; i < j; i++) {
                //r.push(data.instance.get_node(data.selected[i]).li_attr.menuid);
                selectedMenuID = data.instance.get_node(data.selected[i]).li_attr.menuid;
                $("#parentMenuIDHidden").val(selectedMenuID);
                loadThisMenuDetails(selectedMenuID);
                loadSubMenus(selectedMenuID);
            }
            //$('#event_result').html('Selected: ' + r.join(', '));
            //alert(JSON.stringify(r));
        });
    });

    function validateMenuForm(thisForm) {
        var isFormValid = true;

        if ($("#menuName").val().length < 4) {
            isFormValid = false;
            alert("Цэсний нэр буруу байгаа тул дахин шалгана уу. 4 тэмдэгтээс их үсэгтэй байна.");
        }

        if ($("#parentMenuIDHidden").val().length < 1) {
            isFormValid = false;
            alert("Ахлах дээд цэсийг сонгоогүй байна.");
        }

        if (!ValidURL($("#menuURL").val()) && ($("#menuURL").val().length > 0)) {
            isFormValid = false;
            alert("Цэс URL буруу байна. Гадаад бусад холбоосыг зөв бичнэ үү. http, https оруулан бичнэ.");
        }

        return isFormValid;
    }

    function loadThisMenuDetails(selectedMenuID) {
        var selectedMenuID = selectedMenuID;

        $.ajax({
            method: "POST",
            url: "/administrator/service/menu/details",
            data: {dataSwitch: "LSME2336", selectedMenuID: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "menu_id":
                        //$("#menuID").val(value1);
                        //$("#menuActionCodeHidden").val(value1);
                        $("#parentMenuIDHidden").val(value1);
                        break;
                    case "menu_name":
                        //$("#menuName").val(value1);
                        break;
                    case "parent_id":
                        //$("#parentMenuIDHidden").val(value1);
                        break;
                    case "is_static":

                        break;
                    case "url":
                        $("#menuURL").val(value1);
                    case "is_active":
                        /*
                         if (value1 === 1) {
                         $("input[name='menuActive'][value='1']").prop("checked", true);
                         } else if (value1 === 0) {
                         $("input[name='menuActive'][value='0']").prop("checked", true);
                         }
                         */
                        break;
                    default:
                        $("#menuActionTypeHidden").val("create");
                        break;
                }
            });

            $("#menuManagerSaveBtn").removeAttr("disabled");
            $("#menuActionTypeHidden").val("create");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }
</script>

@elseif ($page_type === 'menu_transfer')

<script type="text/javascript">
    $(document).ready(function () {

        $('#newsMenuTree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });

        $('#newsMenuTree').on("changed.jstree", function (e, data) {
            //alert(data.selected);
            var i, j, r = [];
            var selectedMenuID;
            for (i = 0, j = data.selected.length; i < j; i++) {
                //r.push(data.instance.get_node(data.selected[i]).li_attr.menuid);
                selectedMenuID = data.instance.get_node(data.selected[i]).li_attr.menuid;
                $("#movingMenuID").val(selectedMenuID);
            }
            //$('#event_result').html('Selected: ' + r.join(', '));
            //alert(JSON.stringify(r));
        });

        $('#newsMenuTree02').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });

        $('#newsMenuTree02').on("changed.jstree", function (e, data) {
            //alert(data.selected);
            var i, j, r = [];
            var selectedMenuID;
            for (i = 0, j = data.selected.length; i < j; i++) {
                //r.push(data.instance.get_node(data.selected[i]).li_attr.menuid);
                selectedMenuID = data.instance.get_node(data.selected[i]).li_attr.menuid;
                $("#receivingMenuID").val(selectedMenuID);
            }
            //$('#event_result').html('Selected: ' + r.join(', '));
            //alert(JSON.stringify(r));
        });

    });

    function validateMenuTransferForm(thisForm) {
        var isFormValid = true;

        if ($("#movingMenuID").val().length < 1) {
            isFormValid = false;
            alert("Шилжүүлэх цэсийг сонгоогүй байна.");
        }

        if ($("#receivingMenuID").val().length < 1) {
            isFormValid = false;
            alert("Хүлээн авах цэсийг сонгоогүй байна.");
        }

        if ($("#movingMenuID").val() === "1") {
            isFormValid = false;
            alert("Шилжүүлэх цэс нүүр цэс байж болохгүй.");
        }

        if ($("#movingMenuID").val() === $("#receivingMenuID").val()) {
            isFormValid = false;
            alert("Шилжүүлэх мөн хүлээн авах цэсүүд ижил сонгогдсон байж болохгүй.");
        }

        return isFormValid;
    }

</script>

@elseif ($page_type === 'menu_manager')

<script type="text/javascript">
    $(document).ready(function () {

        $('#newsContent').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images&currentFolder=/uploads/',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files&currentFolder=/uploads/',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });

        $('#newsMenuTree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });
        $('#newsMenuTree').on("changed.jstree", function (e, data) {
            //alert(data.selected);
            var i, j, r = [];
            var selectedMenuID;
            for (i = 0, j = data.selected.length; i < j; i++) {
                //r.push(data.instance.get_node(data.selected[i]).li_attr.menuid);
                selectedMenuID = data.instance.get_node(data.selected[i]).li_attr.menuid;
                $("#parentMenuIDHidden").val(selectedMenuID);
                loadThisMenuDetails(selectedMenuID);

                loadSubMenus(selectedMenuID);
                loadSubMenusForOrdering(selectedMenuID);
            }
            //$('#event_result').html('Selected: ' + r.join(', '));
            //alert(JSON.stringify(r));
        });

    });

    function loadThisMenuDetails(selectedMenuID) {
        var selectedMenuID = selectedMenuID;

        $.ajax({
            method: "POST",
            url: "/administrator/service/menu/details",
            data: {dataSwitch: "LSME2336", selectedMenuID: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "menu_id":
                        $("#menuID").val(value1);
                        $("#menuActionCodeHidden").val(value1);
                        break;
                    case "menu_name":
                        $("#menuName").val(value1);
                        break;
                    case "parent_id":
                        $("#parentMenuIDHidden").val(value1);
                        break;
                    case "is_static":

                        break;
                    case "url":
                        $("#menuURL").val(value1);
                    case "is_active":
                        if (value1 === 1) {
                            $("input[name='menuActive'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='menuActive'][value='0']").prop("checked", true);
                        }
                        break;
                    case "is_clickable":
                        if (value1 === 1) {
                            $("input[name='menuIsClickable'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='menuIsClickable'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#menuActionTypeHidden").val("edit");
                        break;
                }
            });

            $("#menuManagerSaveBtn").removeAttr("disabled");
            $("#menuActionTypeHidden").val("edit");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }

    function validateMenuForm(thisForm) {
        var isFormValid = true;

        if ($("#menuName").val().length < 4) {
            isFormValid = false;
            alert("Цэсний нэр буруу байгаа тул дахин шалгана уу. 4 тэмдэгтээс их үсэгтэй байна.");
        }

        if ($("#parentMenuIDHidden").val().length < 1) {
            isFormValid = false;
            alert("Ахлах дээд цэсийг сонгоогүй байна.");
        }

        if (!ValidURL($("#menuURL").val()) && $("#menuURL").val().length > 0) {
            isFormValid = false;
            alert("Цэс URL буруу байна. Гадаад бусад холбоосыг зөв бичнэ үү. http, https оруулан бичнэ.");
        }

        if ($("#menuActionTypeHidden").val() === "edit" && $("#menuActionCodeHidden").val() === "") {
            isFormValid = false;
            alert("Цэс засах цэсний дугаар буруу байнаа тул засах боломжгүй.");
        }

        return isFormValid;
    }

    function loadSubMenus(selectedMenuID) {
        $.ajax({
            method: "POST",
            url: "/administrator/service/menu/sub-menus",
            data: {dataSwitch: "LSME6544", selectedMenuID: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            $("#subMenusTableContainer").html(callBackData);
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }

    function loadSubMenusForOrdering(selectedMenuID) {
        $.ajax({
            method: "POST",
            url: "/administrator/service/load/menu/sub-menus/ordering",
            data: {dataSwitch: "LSFO6548", selectedMenuID: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $('div#divOuter1').html("");
            $.each(msgJSON, function (key1, value1) {
                $('div#divOuter1').append("<div id='div" + key1 + "' data-menuId='" + value1['menu_id'] + "' class='draggable'>" + value1['menu_name'] + " (id:" + value1['menu_id'] + ")</div>");
            });

        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }

    $(document).ready(function () {
        $(".droppable").sortable({
            update: function (event, ui) {
                //Dropped();
            }
        });

        $("#btnSaveMenuOrdering").on("click", function () {
            var orderMenuKeyValues = [];
            $(".draggable").each(function (index) {
                //alert($(this).attr("data-menuId"));
                orderMenuKeyValues.push({
                    "menuId": $(this).attr("data-menuId"),
                    "menuOrder": (index + 1)
                });
            });
            //alert(JSON.stringify(orderMenuKeyValues));
            if (orderMenuKeyValues.length > 1) {
                $.ajax({
                    method: "POST",
                    url: "/administrator/service/update/menu/ordering",
                    data: {dataSwitch: "UMOI2236", orderMenuKeyValues: orderMenuKeyValues, "_token": "{{ csrf_token() }}"}
                }).done(function (callBackData) {
                    alert("Data Saved: " + callBackData);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                }).always(function () {
                    //alert("complete");
                });
            }
            refresh();
        });
    });

    function Dropped(event, ui) {
        $(".draggable").each(function () {
            //var p = $(this).position();
            //alert($(this).attr("data-menuId"));
        });
        refresh();
    }

    function deleteThisSubMenu(thisElement) {
        var $this = $(thisElement);
        var selectedMenuID = $this.data("submenuid");
        if (confirm(selectedMenuID + " дугаартай цэсийг устгах уу?!") === true) {
            $.ajax({
                method: "POST",
                url: "/administrator/service/delete/menu",
                data: {dataSwitch: "DSMI9863", selectedMenuID: selectedMenuID, "_token": "{{ csrf_token() }}"}
            }).done(function (callBackData) {
                //alert("Data Saved: " + callBackData);
                if (callBackData === "yes") {
                    alert(selectedMenuID + " дугаартай цэс амжилттай устгагдсан!.");
                    $this.closest("tr").remove();
                } else if (callBackData === "no") {
                    alert(selectedMenuID + " дугаартай цэс устгах үед алдаа гарсан тул устгаж чадсангүй!.");
                    $this.closest("tr").css({'background': 'rgba(212, 42, 88, 0.3)'});
                } else if (callBackData === "menu_has_child_menus") {
                    alert(selectedMenuID + " дугаартай цэс дэд цэсүүдтэй байгаа тул устгах боломжгүй байна!.");
                } else if (callBackData === "menu_has_news") {
                    alert(selectedMenuID + " дугаартай цэс мэдээ агуулж байгаа тул устгах боломжгүй байна!.");
                }
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        } else {
            //alert("You pressed Cancel!");
        }
    }

    function editThisSubMenu(thisElement) {
        var $this = $(thisElement);
        var selectedMenuID = $this.data("submenuid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/menu/details",
            data: {dataSwitch: "LSME2336", selectedMenuID: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "menu_id":
                        $("#menuID").val(value1);
                        $("#menuActionCodeHidden").val(value1);
                        break;
                    case "menu_name":
                        $("#menuName").val(value1);
                        break;
                    case "parent_id":
                        $("#parentMenuIDHidden").val(value1);
                        break;
                    case "is_static":

                        break;
                    case "url":
                        $("#menuURL").val(value1);
                    case "is_active":
                        if (value1 === 1) {
                            $("input[name='menuActive'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='menuActive'][value='0']").prop("checked", true);
                        }
                        break;
                    case "is_clickable":
                        if (value1 === 1) {
                            $("input[name='menuIsClickable'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='menuIsClickable'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#menuActionTypeHidden").val("edit");
                        break;
                }
            });

            $("#menuManagerSaveBtn").removeAttr("disabled");
            $("#menuActionTypeHidden").val("edit");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }

</script>

@elseif ($page_type === 'news_manager')

<script type="text/javascript">
    var _URL = window.URL || window.webkitURL;
    $(document).ready(function () {
        /*
         CKEDITOR.replace('#newsContent', {
         filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
         filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
         filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
         filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
         });*/

        $('#newsContent').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images&currentFolder=/uploads/',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files&currentFolder=/uploads/',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });

        $('#newsMenuTree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });
        $('#newsMenuTree').on("changed.jstree", function (e, data) {
            //alert(data.selected);
            var i, j, r = [];
            var selectedMenuID;
            for (i = 0, j = data.selected.length; i < j; i++) {
                //r.push(data.instance.get_node(data.selected[i]).li_attr.menuid);
                selectedMenuID = data.instance.get_node(data.selected[i]).li_attr.menuid;
                $("#newsMenuIDHidden").val(selectedMenuID);
                loadMenuNews(selectedMenuID);
                loadMenuErrorNews(selectedMenuID);
            }
            //$('#event_result').html('Selected: ' + r.join(', '));
            //alert(JSON.stringify(r));
        });

        $("#newsCoverImageFile").change(function (e) {
            var image, file;
            if ((file = this.files[0])) {
                image = new Image();
                image.onload = function () {
                    if (this.width < 990 && this.height < 740) {
                        alert("Сонгосон зургийн хэмжээ " + this.width + "px өргөн, " + this.height + "px өндөр байна. Өргөн 990px дээш, урт 470px дээш байх ёстой.");
                        $("#newsCoverImageFile").val("");
                    }
                };
                image.src = _URL.createObjectURL(file);
            }
        });
    });

    function loadMenuNews(selectedMenuID) {
        $.ajax({
            method: "POST",
            url: "/administrator/service/menu/news",
            data: {dataSwitch: "LEMN7895", selectedmenuid: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            $("#menuNewsTableContainer").html(callBackData);
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }

    function loadMenuErrorNews(selectedMenuID) {
        $.ajax({
            method: "POST",
            url: "/administrator/service/menu/error-news",
            data: {dataSwitch: "LMNT8746", selectedmenuid: selectedMenuID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            $("#menuErrorNewsTableContainer").html(callBackData);
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }

    function editThisNews(thisElement) {
        var $this = $(thisElement);
        var selectedNewsID = $this.data("newsid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/news/details",
            data: {dataSwitch: "LMNE1249", selectedNewsID: selectedNewsID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#newsID").val(value1);
                        $("#newsActionCodeHidden").val(value1);
                        break;
                    case "title":
                        $("#newsTitle").val(value1);
                        break;
                    case "date":
                        $("#single_cal2").val(value1);
                        break;
                    case "title_photo":
                        $("#newsCoverImage").attr("src", value1);
                        $("#newsCoverImageNameHidden").val(value1);
                        break;
                    case "brief_text":
                        $("#newsBriefText").val(value1);
                        break;
                    case "description":
                        CKEDITOR.instances['newsContent'].setData(value1);
                        break;
                    case "media_type":
                        $("#newsMediaType>option[value='" + value1 + "']").prop("selected", true);
                        break;
                    case "menu_id":
                        $("#newsMenuIDHidden").val(value1);
                        break;
                    case "view_count":
                        $("#newsViewCount").val(value1);
                        break;
                    case "pdf_file":
                        $("#newsPDFFilenameHidden").val(value1);
                    case "is_breaking":
                        if (value1 === 1) {
                            $("input[name='newsSpecial'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='newsSpecial'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#newsActionTypeHidden").val("edit");
                        //$("#admissionStatus2").prop("checked", true);
                        //$("#admissionType").val(js_AdmissionType);
                        break;
                }
            });
            $("#newsManagerSaveBtn").removeAttr("disabled");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }

    function validateNewsForm(thisForm) {
        var isFormValid = true;
        //var formActionType = $("#newsActionTypeHidden").val();
        //var formPDFFileActionType = $("#newsPDFFileHidden").val();
        //var regexPDFName = /^[.a-zA-Z0-9_-]+$/i;

        if ($("#newsTitle").val().length < 4) {
            alert("Мэдээний гарчиг буруу хэт бага байна. !!!");
            isFormValid = false;
        }

        //------------start upload file check-------------
        var newsCoverFilename = $("#newsCoverImageFile").val();
        if (newsCoverFilename.length < 5) {
            var resultConfirm = confirm("Энэ мэдээ нүүр зураггүй мэдээ юу?.");
            if (resultConfirm === false) {
                alert("Энэ мэдээнд зураг оруулна уу.");
                isFormValid = false;
            }
        }

        /*
         var filename = $("#newsCoverImageFile").val();
         var extension = filename.replace(/^.*\./, '');
         
         if (extension === filename) {
         extension = '';
         } else {
         extension = extension.toLowerCase();
         }
         
         switch (extension) {
         case 'jpg':
         break;
         case 'jpeg':
         break;
         case 'png':
         //alert("it's got an extension which suggests it's a PNG or JPG image (but N.B. that's only its name, so let's be sure that we, say, check the mime-type server-side!)");
         // uncomment the next line to allow the form to submitted in this case:
         break;
         default:
         // Cancel the form submission
         if (formActionType !== "edit") {
         alert("Буруу файл сонгосон байна. Зөвхөн зураг байна. !!!");
         isFormValid = false;
         }
         }
         */
        //------------end upload file check-------------

        /*var pdfFilename = $("#newsPDFFile").val();
         var pdfExtension = pdfFilename.replace(/^.*\./, '');
         if (pdfExtension === pdfFilename) {
         pdfExtension = '';
         } else {
         pdfExtension = pdfExtension.toLowerCase();
         }
         if (pdfExtension !== '' && pdfExtension !== 'pdf' && formPDFFileActionType !== "edit") {
         alert("Буруу файл сонгосон байна. Зөвхөн PDF файл байна. !!!");
         isFormValid = false;
         }*/

        /*if (!regexPDFName.test(pdfFilename) && pdfFilename.length > 0) {
         alert("PDF файлын нэр зөвхөн латин үсэг, тоо байна. !!!");
         isFormValid = false;
         }*/

        if ($("#newsMenuIDHidden").val() === "") {
            alert("Мэдээний цэс сонгоно уу. !!!");
            isFormValid = false;
        }

        var selectedNewsMediaType = $("#newsMediaType").children("option").filter(":selected").val();
        if (selectedNewsMediaType === "none") {
            alert("Мэдээнйи төрөл сонгоно уу.");
            isFormValid = false;
        } else if (selectedNewsMediaType === "1" && newsCoverFilename.length < 5) {
            alert("Мэдээ нүүр хуудас дээр солигдож харагдах тул заавал зураг сонгоно уу.");
            isFormValid = false;
        }

        return isFormValid;
    }

    function deleteThisNews(thisElement) {
        var $this = $(thisElement);
        var selectedNewsID = $this.data("newsid");
        if (confirm(selectedNewsID + " дугаартай мэдээг устгах уу?!") === true) {
            $.ajax({
                method: "POST",
                url: "/administrator/service/delete/news",
                data: {dataSwitch: "DNBI8861", selectedNewsID: selectedNewsID, "_token": "{{ csrf_token() }}"}
            }).done(function (callBackData) {
                //alert("Data Saved: " + callBackData);
                if (callBackData === "yes") {
                    alert(selectedNewsID + " дугаартай мэдээ амжилттай устгагдсан!.");
                    $this.closest("tr").remove();
                } else if (callBackData === "no") {
                    alert(selectedNewsID + " дугаартай мэдээ устгах үед алдаа гарсан тул устгаж чадсангүй!.");
                    $this.closest("tr").css({'background': 'rgba(212, 42, 88, 0.3)'});
                }
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        } else {
            //alert("You pressed Cancel!");
        }
    }

    function viewThisNews(thisElement) {
        var $this = $(thisElement);
        var selectedNewsID = $this.data("newsid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/news/details",
            data: {dataSwitch: "LMNE1249", selectedNewsID: selectedNewsID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#newsID").val(value1);
                        $("#newsActionCodeHidden").val(value1);
                        break;
                    case "title":
                        $("#newsTitle").val(value1);
                        break;
                    case "date":
                        $("#single_cal2").val(value1);
                        break;
                    case "title_photo":
                        //$("#newsSlug").val(value1);
                        break;
                    case "brief_text":
                        $("#newsBriefText").val(value1);
                        break;
                    case "description":
                        CKEDITOR.instances['newsContent'].setData(value1);
                        break;
                    case "media_type":
                        $("#newsMediaType>option[value='" + value1 + "']").prop("selected", true);
                        break;
                    case "menu_id":
                        $("#newsMenuIDHidden").val(value1);
                        break;
                    case "view_count":
                        $("#newsViewCount").val(value1);
                        break;
                    case "is_breaking":
                        if (value1 === 1) {
                            $("input[name='newsSpecial'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='newsSpecial'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#newsActionTypeHidden").val("edit");
                        //$("#admissionStatus2").prop("checked", true);
                        //$("#admissionType").val(js_AdmissionType);
                        break;
                }
            });
            $("#newsManagerSaveBtn").attr("disabled", true);
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }

</script>

@elseif ($page_type === 'complaint_request_manager')
<script type="text/javascript">
    $('#datatableComplaints').dataTable({
        "order": [],
        "pageLength": 25
                // Your other options here...
    });
    function deleteThisComplaint(thisElement) {
        var $this = $(thisElement);
        var selectedComplaintID = $this.data("complaintid");

        if (confirm(selectedComplaintID + " дугаартай хүсэлт мэдээллийг устгах уу?!") === true) {
            $.ajax({
                method: "POST",
                url: "/administrator/service/delete/complaint",
                data: {dataSwitch: "DCDE2239", selectedComplaintID: selectedComplaintID, "_token": "{{ csrf_token() }}"}
            }).done(function (callBackData) {
                //alert("Data Saved: " + callBackData);
                if (callBackData === "yes") {
                    //alert(selectedComplaintID + " дугаартай мэдээ амжилттай устгагдсан!.");
                    $this.closest("tr").remove();
                } else if (callBackData === "no") {
                    alert(selectedComplaintID + " дугаартай мэдээ устгах үед алдаа гарсан тул устгаж чадсангүй!.");
                    $this.closest("tr").css({'background': 'rgba(212, 42, 88, 0.3)'});
                }
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            }).always(function () {
                //alert("complete");
            });
        }
    }

    function viewThisComplaint(thisElement) {
        var $this = $(thisElement);
        var selectedComplaintID = $this.data("complaintid");
        $.ajax({
            method: "POST",
            url: "/administrator/service/load/complaint/details",
            data: {dataSwitch: "LCDE5574", selectedComplaintID: selectedComplaintID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#complaintID").val(value1);
                        $("#complaintActionCodeHidden").val(value1);
                        break;
                    case "name":
                        $("#complaintPersonName").val(value1);
                        break;
                    case "person_register":
                        $("#complaintPersonRegister").val(value1);
                        break;
                    case "email":
                        $("#complaintPersonEmail").val(value1);
                        break;
                    case "complain":
                        $("#complaintText").val(value1);
                        break;
                    case "last_name":

                        break;
                    case "complain_type":
                        $("#complaintType>option[value='" + value1 + "']").prop("selected", true);
                        break;
                    case "phone":
                        $("#complaintPersonPhone").val(value1);
                        break;
                    case "submitted_date":
                        $("#complaintSubmittedAt").val(value1);
                        break;
                    default:
                        break;
                }
                $("#complaintActionTypeHidden").val("edit");
            });
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }

    function validateComplaintForm(thisForm) {
        var isThisFormValid = true;

        var complaintActionTypeValue = $("#complaintActionTypeHidden").val();
        var complaintActionCodeValue = $("#complaintActionCodeHidden").val();

        if (complaintActionTypeValue === "edit" && complaintActionCodeValue === "") {
            alert("Санал, гомдол, хүсэлт засахад үед хэрэглэх дугаар буруу байна.!");
            isThisFormValid = false;
        }

        var selectedComplaintType = $("#complaintType").children("option").filter(":selected").val();
        if (selectedComplaintType === "none") {
            alert("Санал, гомдол, хүсэлт төрөл сонгоно уу.");
            isThisFormValid = false;
        }

        return isThisFormValid;
    }
</script>

@elseif ($page_type === 'faq_manager')
<script type="text/javascript">

    $(document).ready(function () {
        $('#faqContent').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });

    function validateFaqForm(thisForm) {
        var isThisFormValid = true;
        var faqActionTypeValue = $("#faqActionTypeHidden").val();
        var faqActionCodeValue = $("#faqActionCodeHidden").val();

        if (faqActionTypeValue === "edit" && faqActionCodeValue === "") {
            alert("Асуултыг засахад хэрэглэх дугаар буруу байна.!");
            isThisFormValid = false;
        }

        if ($("#faqTitle").val().length < 4) {
            alert("Асуултыг гарчиг асуулт буруу эсвэл хэдэн үсэг бичсэн байна.!");
            isThisFormValid = false;
        }

        return isThisFormValid;
    }

    function editThisFAQ(thisElement) {
        var $this = $(thisElement);
        var selectedFaqID = $this.data("faqid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/faq/details",
            data: {dataSwitch: "LFAQ9647", selectedFaqID: selectedFaqID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#faqID").val(value1);
                        $("#faqActionCodeHidden").val(value1);
                        break;
                    case "question":
                        $("#faqTitle").val(value1);
                        break;
                    case "answer":
                        CKEDITOR.instances['faqContent'].setData(value1);
                        break;
                    case "menu_id":
                        $("#view_count").val(value1);
                        break;
                    case "view_count":
                        $("#newsViewCount").val(value1);
                        break;
                    case "is_active":
                        if (value1 === 1) {
                            $("input[name='faqActive'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='faqActive'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        //$("#faqActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#faqManagerSaveBtn").removeAttr("disabled");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            $("#faqActionTypeHidden").val("edit");
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }
</script>

@elseif ($page_type === 'link_manager')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script type="text/javascript">

    $('#lfm').filemanager('image');

    function editThisLink(thisElement) {
        var $this = $(thisElement);
        var selectedLinkID = $this.data("linkid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/link/details",
            data: {dataSwitch: "LLDE7862", selectedLinkID: selectedLinkID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "link_id":
                        $("#linkID").val(value1);
                        $("#linkActionCodeHidden").val(value1);
                        break;
                    case "link_url":
                        $("#linkURL").val(value1);
                        break;
                    case "link_pic":
                        $("#linkPicture").val(value1);
                        break;
                    case "is_active":
                        if (value1 === 1) {
                            $("input[name='linkActive'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='linkActive'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        //$("#faqActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#linkManagerSaveBtn").removeAttr("disabled");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            $("#linkActionTypeHidden").val("edit");
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }
</script>

@elseif ($page_type === 'general_info_manager')
<script type="text/javascript">
    $(document).ready(function () {
        $('#generalInfoGreeting').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });
</script>

@elseif ($page_type === 'event_manager')
<script type="text/javascript">
    var email_check_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    $(document).ready(function () {
        $('#eventStartTime').datetimepicker({
            format: 'HH:mm'
        });
        $('#eventEndTime').datetimepicker({
            format: 'HH:mm'
        });

        $('#eventContent').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });

    function deleteThisEvent(thisElement) {
        var $this = $(thisElement);
        var selectedEventID = $this.data("eventid");

        if (confirm(selectedEventID + ' дугаартай үйл ажиллагааг устгах гэж байна уу?')) {
            // Save it!
        } else {
            return;
        }

        $.ajax({
            method: "POST",
            url: "/administrator/service/delete/event",
            data: {dataSwitch: "DEDC6617", selectedEventID: selectedEventID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            if (callBackData === "yes") {
                alert(selectedEventID + " дугаартай үйл ажиллагаа амжилттай устгагдсан!.");
                $this.closest("tr").remove();
            } else if (callBackData === "no") {
                alert(selectedEventID + " дугаартай үйл ажиллагааг устгах үед алдаа гарсан тул устгаж чадсангүй!.");
                $this.closest("tr").css({'background': 'rgba(212, 42, 88, 0.3)'});
            }
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    }

    function editThisEvent(thisElement) {
        var $this = $(thisElement);
        var selectedEventID = $this.data("eventid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/event/details",
            data: {dataSwitch: "LEDE5586", selectedEventID: selectedEventID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "id":
                        $("#eventID").val(value1);
                        $("#eventActionCodeHidden").val(value1);
                        break;
                    case "event_title":
                        $("#eventTitle").val(value1);
                        break;
                    case "event_content":
                        CKEDITOR.instances['eventContent'].setData(value1);
                        break;
                    case "event_date":
                        $("#single_cal2").val(value1);
                        break;
                    case "event_time_starts":
                        $("#eventStartTimeId").val(value1);
                        break;
                    case "event_time_ends":
                        $("#eventEndTimeId").val(value1);
                        break;
                    case "event_cover_img":
                        $("#eventCoverImage").attr("src", "/uploads/event/covers/" + value1);
                        $("#eventCoverImageNameHidden").val(value1);
                        break;
                    case "event_location":
                        $("#eventLocation").val(value1);
                        break;
                    case "event_phones":
                        $("#eventPhones").val(value1);
                        break;
                    case "event_emails":
                        $("#eventEmail").val(value1);
                        break;
                    case "event_active":
                        if (value1 === 1) {
                            $("input[name='eventStatus'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='eventStatus'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        //$("#faqActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#eventManagerSaveBtn").removeAttr("disabled");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            $("#eventActionTypeHidden").val("edit");
            //alert("complete");
            //$("#newsletterInputedEmail").val("");
        });
    }

    function validateEventForm(thisForm) {
        var isFormValid = true;

        if ($("#eventTitle").val().length < 5) {
            isFormValid = false;
            alert("Үйл ажиллагааны гарчиг буруу эсвэл бага үсэгтэй бичигдсэн байна.");
        }

        if ($("#eventCoverImageFile").val().length < 5 && $("#eventActionTypeHidden").val() === "create") {
            isFormValid = false;
            alert("Үйл ажиллагааны нүүр зураг буруу сонгосон байна.");
        }

        if ($("#eventLocation").val().length < 5) {
            isFormValid = false;
            alert("Үйл ажиллагаа болох байршилын хаяг буруу бичигдсэн эсвэл бага үсэгтэй бичигдсэн байна.");
        }

        if ($("#eventPhones").val().length < 5) {
            isFormValid = false;
            alert("Үйл ажиллагааны талаар холбоо барих утас буруу эсвэл бага үсэгтэй бичигдсэн байна.");
        }

        if (!email_check_regex.test($("#eventEmail").val())) {
            isFormValid = false;
            alert("Үйл ажиллагааны гарчиг буруу имэйл хаяг бичсэн байна.");
        }
        //alert("sdfsdf hgaskdfhsajhdf sad");
        return isFormValid;
    }

    $(function () {
        $('#eventCoverImageFile').change(function () {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg"))
            {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#eventCoverImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#eventCoverImage').attr('src', '/images/no_image.png');
            }
        });
    });

</script>

@elseif ($page_type === 'marquee_manager')

<script type="text/javascript">
    function editThisAds(thisElement) {
        var $this = $(thisElement);
        var selectedAdsID = $this.data("adsid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/marquee/details",
            data: {dataSwitch: "LMDE5537", selectedAdsID: selectedAdsID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "ads_id":
                        $("#marqueeID").val(value1);
                        $("#marqueeActionCodeHidden").val(value1);
                        break;
                    case "ads_name":
                        $("#marqueeName").val(value1);
                        break;
                    case "ads_text":
                        $("#marqueeValue").val(value1);
                        break;
                    case "ads_position":
                        $("#marqueePosition>option[value='" + value1 + "']").prop("selected", true);
                        break;
                    case "ads_dead":
                        $("#single_cal2").val(value1);
                        break;
                    case "ads_active":
                        if (value1 === 1) {
                            $("input[name='marqueeActive'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='marqueeActive'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        //$("#faqActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#marqueeManagerSaveBtn").removeAttr("disabled");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            $("#marqueeActionTypeHidden").val("edit");
            //alert("complete");
        });
    }

</script>

@elseif ($page_type === 'page_manager')
<script type="text/javascript">
    $(document).ready(function () {
        $('#pagePreview').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });

        $('#pageContent').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });

    function editThisPage(thisElement) {
        var $this = $(thisElement);
        var selectedPageID = $this.data("pageid");

        $.ajax({
            method: "POST",
            url: "/administrator/service/load/page/details",
            data: {dataSwitch: "LPDE2267", selectedPageID: selectedPageID, "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            msgJSON = JSON.parse(callBackData);
            $.each(msgJSON, function (key1, value1) {
                switch (key1) {
                    case "page_id":
                        $("#pageID").val(value1);
                        $("#pageActionCodeHidden").val(value1);
                        break;
                    case "page_name":
                        $("#pageTitle").val(value1);
                        break;
                    case "page_preview":
                        CKEDITOR.instances['pagePreview'].setData(value1);
                        break;
                    case "page_content":
                        CKEDITOR.instances['pageContent'].setData(value1);
                        break;
                    case "page_view_count":
                        $("#pageViewCount").val(value1);
                        break;
                    case "page_cover_img":
                        $("#pageCoverImage").attr("src", "/uploads/page/covers/" + value1);
                        $("#pageCoverImageNameHidden").val(value1);
                        break;
                    case "page_url":
                        $("#pageLiveURL").val(value1);
                        $("#pageUrl").val(value1);
                        break;
                    case "page_active":
                        if (value1 === 1) {
                            $("input[name='pageActiveStatus'][value='1']").prop("checked", true);
                        } else if (value1 === 0) {
                            $("input[name='pageActiveStatus'][value='0']").prop("checked", true);
                        }
                        break;
                    default:
                        $("#pageActionTypeHidden").val("edit");
                        break;
                }
            });
            $("#pageManagerSaveBtn").removeAttr("disabled");
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        }).always(function () {
            $("#marqueeActionTypeHidden").val("edit");
            //alert("complete");
        });
    }
</script>
@else


Include section anything

@endif