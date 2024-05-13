(function ($) {
    "use strict";
    var HT = {};
    var counter = 1;

    HT.addSlide = (type) => {
        $(document).on('click', '.addSlide', function (e) {
            e.preventDefault()
            if (typeof (type) == 'undefined') {
                type = 'Images';
            }
            var finder = new CKFinder();
            finder.resourceType = type;
            finder.selectActionFunction = function (fileUrl, data, allFiles) {
                let html = ''
                for(var i = 0; i < allFiles.length; i++){
                  let image = allFiles[i].url
                  html += HT.renderSlideItemHtml(image)
                }
                $('.slide-list').append(html)
                HT.slideCheckNotification()
            }
            finder.popup();
        })
    }

    HT.slideCheckNotification = () => {
        let slideItem = $('.slide-item')
        if(slideItem.length){
            $('.slide-notification').hide()
        }else{
            $('.slide-notification').show()
        }
    }

    HT.renderSlideItemHtml = (image) => {
        let tab_1 = "tab-" + counter
        let tab_2 = "tab-" + (counter + 1)

        let html = `<div class="col-lg-12 ui-state-default">
        <div class="slide-item mb20">
            <div class="row custom-row">
                <div class="col-sm-3">
                    <span class="slide-image img-cover">
                        <img src="${image}"
                            alt="">
                        <input type="hidden" name="slide[image][]" id="" value="${image}">
                        <span class ="deleteSlide btn btn-danger"><i class ="fa fa-trash" ></i></span>
                    </span>
                </div>
                <div class="col-sm-9">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#${tab_1}">Thông tin
                                    chung</a></li>
                            <li class=""><a data-toggle="tab" href="#${tab_2}">SEO</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="${tab_1}" class="tab-pane active">
                                <div class="panel-body">
                                    <label for="" class="control-label text-left">Mô tả <span
                                            class="text-danger">(*)</span></label>
                                    <div class="form-row mb10">
                                        <textarea name="slide[description][]" class="form-control"></textarea>
                                    </div>
                                    <div class="form-row custom-form-url">
                                        <input type="text" name="slide[canonical][]" placeholder="URL"
                                            class="form-control ">
                                        <div class="overlay">
                                            <div class="uk-flex uk-flex-middle">
                                                <label for="input_${tab_1}" class="control-label text-bold">Mở
                                                    trong tab mới</label>
                                                <input type="checkbox" name="slide[window][]" value="_blank"
                                                    id="input_${tab_1}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="${tab_2}" class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-row custom-form-url seo-slide">
                                        <label for="" class="control-label text-left">Tiêu đề
                                            ảnh<span class="text-danger">(*)</span></label>
                                        <input type="text" name="slide[name][]"
                                            placeholder="Nhập tiêu đề ảnh..." class="form-control ">
                                    </div>
                                    <div class="form-row custom-form-url mt10 seo-slide">
                                        <label for="" class="control-label text-left">Mô tả
                                            ảnh<span class="text-danger">(*)</span></label>
                                        <input type="text" name="slide[alt][]" placeholder="Nhập mô tả ảnh..."
                                            class="form-control ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>`

        counter +=2

        return html
    }

    HT.deleteSlide = () => {
        $(document).on('click', '.deleteSlide', function(){
            let _this = $(this)
            _this.parents('.ui-state-default').remove()
            HT.slideCheckNotification()
        })
    }

    $(document).ready(function () {
        HT.addSlide()
        HT.deleteSlide()
    });

})(jQuery);