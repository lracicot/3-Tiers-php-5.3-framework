    function add_item(item, confirm)
    {
        if(typeof(confirm) == 'undefined')
        {
            confirm = '0';
        }
        $('#popup').hide();
        $('#popup').load(window.apppath+'cart/add/'+item+'/'+confirm);
        $('#popup').show();

        $('#nb_items').load(window.apppath+'cart/nb');
    }