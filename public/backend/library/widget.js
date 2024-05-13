(function ($) {
    "use strict";
    var HT = {};
    let typingTimer;
    let doneTyingInterval = 500;

    HT.searchModule = () => {
        $(document).on('keyup', '.search-model', function (e) {
            e.preventDefault()
            let _this = $(this)
            if ($('input[type=radio]:checked').length === 0) {
                alert('Bạn chưa chọn module');
                _this.val('')
                return false;
            }

            let keyword = _this.val()
            let option = {
                model: $('input[type=radio]:checked').val(),
                keyword: keyword
            }
            HT.sendAjax(option)

        })
    }

    HT.chooseModal = () => {
        $(document).on('click', 'input-radio', function () {
            let _this = $(this)
            let option = {
                model: _this.val(),
                keyword: $('.search-model').val()
            }
            $('.search-model-result').html('');
            if (keyword >= '2') {
                HT.sendAjax(option)
            }
        })
    }

    HT.sendAjax = (option) => {
        clearTimeout(typingTimer)
        typingTimer = setTimeout(function () {
            $.ajax({
                url: 'ajax/dashboard/findModelObject',
                type: 'GET',
                data: option,
                dataType: 'json',
                success: function (res) {
                    let html = HT.renderSearchResult(res)
                    if (html.length) {
                        $('.ajax-search-result').html(html).show()
                    } else {
                        $('.ajax-search-result').html(html).hide()
                    }
                },
                beforeSend: function () {
                    $('.ajax-search-result').html('').hide()
                },

            })
        }, doneTyingInterval);
    }

    HT.renderSearchResult = (data) => {
        let html = ''

        if (data.length) {
            for (let i = 0; i < data.length; i++) {

                let flag = ($('#model-'+data[i].id).length) ? 1 : 0;
                let setChecked =  ($('#model-'+data[i].id).length) ? HT.autoIcon() : ''
                html += `<button 
                            class="ajax-search-item" 
                            data-canonical = "${data[i].languages[0].pivot.canonical}" 
                            data-image="${data[i].image}" 
                            data-id = "${data[i].id}"
                            data-name = "${data[i].languages[0].pivot.name}"
                            data-flag ="0"
                        >
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <span>
                        ${data[i].languages[0].pivot.name}
                    </span>
                    <div class="auto-icon">
                        ${setChecked}
                    </div>
                </div>
            </button>`
            }
        }
        return html;
    }

    HT.autoIcon = () => {
        return `<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
        <path d="M 41.9375 8.625 C 41.273438 8.648438 40.664063 9 40.3125 9.5625 L 21.5 38.34375 L 9.3125 27.8125 C 8.789063 27.269531 8.003906 27.066406 7.28125 27.292969 C 6.5625 27.515625 6.027344 28.125 5.902344 28.867188 C 5.777344 29.613281 6.078125 30.363281 6.6875 30.8125 L 20.625 42.875 C 21.0625 43.246094 21.640625 43.410156 22.207031 43.328125 C 22.777344 43.242188 23.28125 42.917969 23.59375 42.4375 L 43.6875 11.75 C 44.117188 11.121094 44.152344 10.308594 43.78125 9.644531 C 43.410156 8.984375 42.695313 8.589844 41.9375 8.625 Z"></path>
    </svg>`
    }

    HT.unforcusSearchBox = () => {
        $(document).on('click', 'html', function (e) {
            if (!$(e.target).hasClass('search-model-box') && !$(e.target).hasClass('search-model')) {
                $('.ajax-search-result').html('')
            }
        })

        $(document).on('click', '.ajax-search-result', function (e) {
            e.stopPropagation()
        })
    }

    HT.addModel = () => {
        $(document).on('click', '.ajax-search-item', function (e) {
            e.preventDefault()
            let _this = $(this)
            let data = _this.data()
            let html = HT.modelTemplate(data)
            let flag = _this.attr('data-flag')
            if (flag == 0) {
                _this.find('.auto-icon').html(HT.autoIcon())
                _this.attr('data-flag', 1)
                $('.search-model-result').append(HT.modelTemplate(data))
            }
            else {
                $('#model-'+data.id).remove()
                _this.find('auto-icon').html('')
                _this.attr('data-flag', 0)
            }



        })
    }

    HT.modelTemplate = (data) => {
        let html = `<div class="search-result-item" id="model-${data.id}" data-modeId = "${data.id}">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="uk-flex uk-flex-middle">
                <span class="image img-cover">
                    <img src="${data.image}" alt="">
                </span>
                <span class="name">${data.name}</span>
            </div>
            <div class = "hidden">
                <input type ="text" name="modelItem[id][]" value ="${data.id}">
                <input type ="text" name="modelItem[name][]" value ="${data.name}">
                <input type ="text" name="modelItem[image][]" value ="${data.image}">
            </div>
            <div class="deleted">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                    viewBox="0 0 24 24">
                    <path
                        d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z">
                    </path>
                </svg>
            </div>
        </div>
       </div>`
        return html;
    }

    HT.removeModel = () => {
        $(document).on('click', '.deleted', function() {
            let _this = $(this)
            _this.parents('.search-result-item').remove()
        })
    }

    $(document).ready(function () {
        HT.searchModule()
        HT.chooseModal()
        HT.unforcusSearchBox()
        HT.addModel()
        HT.removeModel()
    });

})(jQuery);