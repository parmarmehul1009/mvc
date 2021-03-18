var Base = function() {

}
Base.prototype = {
    url: null,
    params: {},
    method: 'post',
    form: null,

    setUrl: function(url) {
        this.url = url;
        return this;
    },

    getUrl: function() {
        return this.url;
    },

    setMethod: function(method) {
        this.method = method;
        return this;
    },

    resetPrams: function() {
        this.params = {};
        return this;
    },

    getMethod: function() {
        return this.method;
    },

    setParams: function(params) {
        this.params = params;
        return this;
    },

    getParams: function(key) {
        if (typeof key === 'undefined') {
            return this.params;
        }
        if (typeof this.params[key] === 'undefined') {
            return null;
        }
        return this.params[key];
    },

    addParam: function(key, value) {
        this.params[key] = value;
        return this;
    },

    removeParam: function(key) {
        if (typeof this.params[key] != undefined) {
            delete this.params[key];
        }
        return this;
    },

    load: function() {

        var self = this;

        var request = $.ajax({
            url: this.getUrl(),
            method: this.getMethod(),
            data: this.getParams(),
            processData: false,
            success: function(response) {
                self.manageHtml(response);
            }
        });

    },

    load1: function() {

        var self = this;

        var request = $.ajax({
            url: this.getUrl(),
            method: this.getMethod(),
            data: this.getParams(),
            success: function(response) {
                self.manageHtml(response);
            }
        });

    },

    manageHtml: function(response) {
        if (typeof response.element == 'undefined') {
            return false;
        }
        if (typeof response.element == 'object') {
            $(response.element).each(function(i, element) {
                $(element.selector).html(element.html);
            })
        } else {
            $(response.element.selector), html(response.element.html);
        }
    },

    setForm: function(button) {
        this.form = $(button).closest("form");
        this.setParams(this.form.serialize());
        this.setMethod(this.form.attr('method'));
        this.setUrl(this.form.attr('action'));
        return this;
    },

    setFile: function(button, id) {
        this.form = $(button).closest("form");
        var data = new FormData();
        var file = $(id)[0].files;
        data.append('file', file[0]);
        this.setParams(data);
        this.setMethod(this.form.attr('method'));
        return this;
    },

    uploadFile: function() {
        var self = this;
        var request = $.ajax({
            url: this.getUrl(),
            method: this.getMethod(),
            data: this.getParams(),
            processData: false,
            contentType: false,
            success: function(response) {
                self.manageHtml(response);
                self.removeParam();
            }
        });
        return this;
    },

    getForm: function() {
        return this.form;
    },

    setCms: function(button) {
        this.form = $(button).closest("form");
        this.setMethod(this.form.attr("method"));
        this.setUrl(this.form.attr("action"));
        cmsContent = CKEDITOR.instances['editor'].getData();
        this.addParam("cms_page[content]", cmsContent);
        this.addParam("cms_page[title1]", document.getElementById('title1').value);
        this.addParam("cms_page[identifier]", document.getElementById('identifier').value);
        this.addParam("cms_page[status]", document.getElementById('status').value);
        return this;
    }
}

var mage = new Base();