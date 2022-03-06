// Start function Ajax_All
function Ajax_All(name, data, url=false){
    $.ajax({
        url: url,
        method: 'POST',
        data: { 'name': name,'data':  data },
        dataType: "html",
        beforeSend: function(){
            // Loader O
            $('.body-load').addClass('body-load-none');

        },
        success: function(result){
            // Loader O
        	$('.body-load').removeClass('body-load-none');
            console.log(result);
            json = jQuery.parseJSON(result);
            // Ҳаммаи функсияҳо дар дохили худди файлҳоянд
            if(json.message && json.locat_function=='default') swal({ title: json.title, text: json.message, icon: json.icon, buttons: json.button });
            else if(json.url){ 
                if ( json.time ) {
                    let Secund = json.time * 1000;
                    let SwalSecund = Secund - 1000;
                    swal({ title: json.title, text: json.message, icon: json.icon, buttons: json.button, timer: SwalSecund  });
                    setTimeout(function () {
                        window.location.href = json.url; 
                    }, Secund);
                }
                else window.location.href = json.url; 
            }
            else if(name == 'pay_axia') pay_axia(json); 
            else if(name == 'search_treder_all') search_treder_all(json); 
            else if(name == 'search_user_pay') search_user_pay(json); 
            else if(name == 'search_user_pay_yoshop') search_user_pay_yoshop(json); 
            else if(name == 'add_chat') add_chat(json); 
            else console.log('Error: file ajax.js name not faud!');
            
        } //success
    }); //$.ajax
}// End function Ajax_All















