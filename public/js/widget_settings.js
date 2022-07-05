function update() {

    var widget_page_name = $('#widget_page_name').val();
    var page_bg_color = $('#page_bg_color').val();
    var item_bg_color = $('#item_bg_color').val();
    var item_text_color = $('#item_text_color').val();
    var item_border_size = $('#item_border_size').val();
    var item_border_color = $('#item_border_color').val();


    var data = "page_bg_color=" + page_bg_color + "&item_bg_color=" + item_bg_color + "&item_text_color=" + item_text_color + "&item_border_size=" + item_border_size + "&item_border_color=" + item_border_color + "&_token=" + $('#_token').val();
    var base_url = "https://" + window.location.hostname;
    console.log(base_url + "/embed/widgets/" + widget_page_name + "/" + data);
    $.ajax({
        type: "POST",
        url: "/encrypt_data",
        data: data,
        success: function(data) {
            var url = base_url + "/embed/widgets/" + widget_page_name + "/" + data;
            $('#embed_url').val(url);
            $('#live_view').attr('src', url);
        }
    });
}