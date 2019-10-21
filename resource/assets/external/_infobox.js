function drawInfobox(category, infoboxContent, json, i){

    if(json.data[i].color)          { var color = json.data[i].color }
        else                        { color = '' }
    if( json.data[i].price )        { var price = '<div class="price">EVENT</div>' }
        else                        { price = '' }
    if(json.data[i].id)             { var id = json.data[i].id }
        else                        { id = '' }
    if(json.data[i].url)            { var url = json.data[i].url }
        else                        { url = '' }
    if(json.data[i].type)           { var type = json.data[i].type }
        else                        { type = '' }
    if(json.data[i].title)          { var title = json.data[i].title }
        else                        { title = '' }
    if(json.data[i].location)       { var location = json.data[i].location }
        else                        { location = '' }
    if(json.data[i].gallery[0])     { var gallery = json.data[i].gallery[0] }
        else                        { gallery[0] = '../img/default-item.jpg' }

    var ibContent = '';
    ibContent =
    '<div class="infobox ' + color + '">' +
        '<div class="inner">' +
            '<div class="image">' +
                '<div class="item-specific">' + drawItemSpecific(category, json, i) + '</div>' +
                '<div class="overlay">' +
                    '<div class="wrapper">' +
                        '<a href="#" class="quick-view" data-toggle="modal" data-target="#modal" id="' + id + '" data-seq="'+json.data[i].ai_seq+'">바로가기</a>' +
                        '<hr>' +
                    '</div>' +
                '</div>' +
                '<a href="#" class="description quick-view" data-toggle="modal" data-target="#modal" id="'+id+'" data-seq="'+json.data[i].ai_seq+'">' +
                    '<div class="meta">' +
                        price +
                        '<h2>' + title +  '</h2>' +
                        '<figure>' + location +  '</figure>' +
                        '<i class="fa fa-angle-right"></i>' +
                    '</div>' +
                '</a>' +
                '<img src="' + gallery +  '">' +
            '</div>' +
        '</div>' +
    '</div>';

    return ibContent;
}



function drawInfobox_new(category, infoboxContent, data){

    if(data.color)          { var color = data.color }
        else                        { color = '' }
    if( data.price )        { var price = '<div class="price">EVENT</div>' }
        else                        { price = '' }
    if(data.id)             { var id = data.id }
        else                        { id = '' }
    if(data.url)            { var url = data.url }
        else                        { url = '' }
    if(data.type)           { var type = data.type }
        else                        { type = '' }
    if(data.title)          { var title = data.title }
        else                        { title = '' }
    if(data.location)       { var location = data.location }
        else                        { location = '' }
    if(data.gallery[0])     { var gallery = data.gallery[0] }
        else                        { gallery[0] = '../img/default-item.jpg' }

    var ibContent = '';
    ibContent =
    '<div class="infobox ' + color + '">' +
        '<div class="inner">' +
            '<div class="image">' +
                '<div class="item-specific"></div>' +
                '<div class="overlay">' +
                    '<div class="wrapper">' +
                        '<a href="#" class="quick-view" data-toggle="modal" data-target="#modal" id="' + data.ai_seq + '" data-seq="'+data.ai_seq+'">바로가기</a>' +
                        '<hr>' +
                    '</div>' +
                '</div>' +
                '<a href="#" class="description quick-view" data-toggle="modal" data-target="#modal" id="'+data.ai_seq+'" data-seq="'+data.ai_seq+'">' +
                    '<div class="meta">' +
                        price +
                        '<h2>' + title +  '</h2>' +
                        '<figure>' + location +  '</figure>' +
                        '<i class="fa fa-angle-right"></i>' +
                    '</div>' +
                '</a>' +
                '<img src="' + gallery +  '">' +
            '</div>' +
        '</div>' +
    '</div>';

    return ibContent;
}