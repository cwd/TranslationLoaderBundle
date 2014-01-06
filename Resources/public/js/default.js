jQuery(document).ready(function(){
    var modal = initModal(),
        basePath = '/admin/translations';
    try{
        jQuery('.translation-list tr').click(function(){
            var item = jQuery(this);
            jQuery.ajax({
                url: basePath + '/edit',
                data: {
                    'locale': item.data('locale'),
                    'domain': item.data('domain'),
                    'key': item.data('key')
                },
                success: function(data) {
                    modal.append(data);
                    modal.dialog('open');
                }
            });
        });
    } catch (e) {
        console.log(e);
    }
});

function initModal(){
    var modal = jQuery('#translation-modal-layer');
    modal.dialog({
        height: 400,
        widht: 600,
        position: 'center',
        autoOpen: false,
        modal: true,
        close: function(){
            jQuery(this).children('.content').empty();
        }
    });

    return modal;
};

/**
 var textarea = $('<textarea style="height: 276px;">');
 $(textarea).redactor({
                focus: true,
                autoresize: false,
                initCallback: function()
                {
                    this.set('<p>Lorem...</p>');
                }
            });
 */
