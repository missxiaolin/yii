module.exports = (function($, common) {
    var SearchBox = function(_op) {
        if (common) {
            common.inherit(this, common.Observer);
        } else {
            $.inherit(this, $.Observer);
        }
        var self = this;

        self.op = $.extend({}, {
            keyword: '#keyword',
            searchContainer: '.content-wrap',
            resources: [],
            reqData: {}
        }, _op);

        this.bindEvent();
    };

    SearchBox.prototype.bindEvent = function() {
        var self = this;
        var $keyword = $(self.op.keyword);
        var $searchContainer = $(self.op.searchContainer);

        self.$keywordDom = $keyword;

        $keyword.each(function(i, e){
            $(e).autocomplete({
                minLength: 0,
                source: function (request, response) {
                    self.getSearchData(request.term, response);
                },
                messages: {
                    noResults: '',
                    results: function() {}
                },
                focus: function (event, ui) {
                    this.value = ui.item.name;
                    $(this).attr('data-id', ui.item.id);
                    self.trigger('search_box_focus', [ui, event]);
                    event.preventDefault();
                },
                select: function (event, ui) {
                    ui.item.value = ui.item.name;
                    $(this).attr('data-id', ui.item.id);
                    self.trigger('search_box_selected', [ui, event]);
                }
            });

            $(e).autocomplete('instance')._renderItem = function (ul, item) {
                return $("<li></li>").append("<a href='javascript:;'>" + item.name + "</a>").appendTo(ul);
            };

            $(e).autocomplete('instance')._resizeMenu = function () {
                var ul = this.menu.element;
                ul.outerWidth(Math.max(0, this.element.outerWidth()));
                $searchContainer.append(ul);
            };

        });
    };

    SearchBox.prototype.getSearchData =function (keyword, response) {
        var self = this;

        if($.isArray(self.op.resources)) {
            response(self.op.resources);
        } else if (typeof self.op.resources == 'string') {
            $.ajax({
                type: 'GET',
                url: self.op.resources,
                data: self.op.reqData,
                dataType: 'json',
                success: function(da) {
                    response(da);
                }
            });
        } else {
            var requestData = $.extend({}, self.op.reqData, {
                keyword: keyword
            });
            self.op.resources({
                data: requestData,
                success: function (data) {
                     response(data);
                },
                error: function () {}
            });
        }
    };

     SearchBox.prototype.changeResquestData = function(reqData) {
        this.op.reqData = reqData;
     };

    return SearchBox;
})(jQuery, window.AGJ && window.AGJ.common);
