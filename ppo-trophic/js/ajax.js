var reload = false;
var paged = 2;
var loading = false;
function displayBarNotification(n,c,m){
    var nNote = jQuery("#nNote");
    if(n){
        nNote.attr('class', '').addClass("nNote " + c).fadeIn().html(m);
        setTimeout(function(){
            nNote.attr('class', '').hide("slow").html("");
        }, 10000);
    }else{
        nNote.attr('class', '').hide("slow").html("");
    }
}
function displayAjaxLoading(n){
    n?jQuery(".ajax-loading-block-window").show():jQuery(".ajax-loading-block-window").hide("slow");
}
function ShowPoupEditOrder(){
    displayAjaxLoading(true);
    jQuery.get(ajaxurl, {
        'action':'loadCartEditOrder'
    }, function(data) {
        jQuery.colorbox({
            html:data, 
            overlayClose: false,
            onClosed:function(){
                if(reload){
                    window.location.reload();
                }
            }
        });
        displayAjaxLoading(false);
    });
}
function ShowPoupOrderDetail(html){
    displayAjaxLoading(true);
    jQuery.colorbox({
        width: 840,
        html:html,
        fixed: true
    });
    displayAjaxLoading(false);
}
function ShowPoupCartDetail(html){
    displayAjaxLoading(true);
    jQuery.colorbox({
        width: 840,
        href:html,
        fixed: true
    });
    displayAjaxLoading(false);
}
var AjaxCart = {
    addToCart:function(id, thumb, title, price, quantity, redirect_url){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "json", cache: false,
            data: {
                action: 'addToCart',
                id: id,
                thumb: thumb,
                title: title,
                price: price,
                quantity: quantity,
                locale: lang
            },
            success: function(response, textStatus, XMLHttpRequest){
                if(response && response.status == 'success'){
                    if(redirect_url.length == ""){
                        jQuery(".cart-count").html(response.countCart);
//                        $(".cart-price").html(response.totalAmount);
                        displayBarNotification(true, "nSuccess", response.message);
                    }else{
                        setLocation(redirect_url);
                    }
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete:function(){
                displayAjaxLoading(false);
            }
        });
    },
    deleteItem:function(product_id){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "json", cache: false,
            data: {
                action: 'deleteCartItem',
                id: product_id,
                locale: lang
            },
            success: function(response, textStatus, XMLHttpRequest){
                if(response && response.status == 'success'){
                    jQuery(".cart-count").html(response.countCart);
                    jQuery(".cart-price").html(response.totalAmount);
                    jQuery("#product_item_" + product_id).remove();
                    displayBarNotification(true, "nSuccess", response.message);
                    reload = true;
                   
                }else if(response.status == 'error'){
                    displayBarNotification(true, "nWarning", response.message);
                }
            },  
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete:function(){
                displayAjaxLoading(false);
            }
        }); 
    },
    updateItem:function(product_id, quantity){
        if(quantity == 0){
            AjaxCart.deleteItem(product_id);
        }else{
            displayAjaxLoading(true);
            jQuery.ajax({
                url: ajaxurl, type: "POST", dataType: "json", cache: false,
                data: {
                    action: 'updateCartItem',
                    id: product_id,
                    quantity: quantity,
                    locale: lang
                },
                success: function(response, textStatus, XMLHttpRequest){
                    if(response && response.status == 'success'){
                        jQuery("#product_item_" + product_id + " .product-subtotal").html(response.item_amount);
                        jQuery(".cart-price span.total_price").html(response.totalAmount);
                        displayBarNotification(true, "nSuccess", response.message);
                        reload = true;
                    }else if(response.status == 'error'){
                        displayBarNotification(true, "nWarning", response.message);
                    }
                },  
                error: function(MLHttpRequest, textStatus, errorThrown){},
                complete:function(){
                    displayAjaxLoading(false);
                }
            }); 
        }
    },
    preCheckout:function(){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "json", cache: false,
            data: {
                action: 'preCheckout',
                locale: lang
            },
            success: function (response) {
                if(response && response.status == 'success'){
                    setLocation(checkoutUrl);
                }else if(response.status == 'error'){
                    displayBarNotification(true, "nWarning", response.message);
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete: function(){
                displayAjaxLoading(false);
            }
        });
    },
    orderComplete:function(data){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "json", cache: false, data: data,
            success: function (response) {
                if(response && response.status == 'success'){
                    displayBarNotification(true, "nSuccess", response.message);
                    setTimeout(function(){
                        setLocation(siteUrl);
                    }, 10000);
                }else if(response.status == 'error'){
                    displayBarNotification(true, "nWarning", response.message);
                }else if(response.status == 'failure'){
                    displayBarNotification(true, "nFailure", response.message);
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete: function(){
                displayAjaxLoading(false);
            }
        });
    }
};
jQuery(document).ready(function($){
    $("#nNote").click(function(){
        $(this).attr('class', '').hide("slow").html("");
    });
});