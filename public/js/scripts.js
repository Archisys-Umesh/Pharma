
$isApp = false;
GVSubmitActor = {name:'none',value:'none'};


$(document).ready(function(){
    
    // Init Modal Handlers
    initModalForms();        
    
    // Init Data Widgets
    initWidgetBlocks();
    
    uiManager("");
});

function initWidgetBlocks()
{
    $('[data-toggle="dataWidgets"]').each(function(idx,obj){
        
        $(obj).html("<div class='progress progress-sm'><div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='89' aria-valuemin='0' aria-valuemax='100'></div></div>");        
        $(obj).find(".progress-bar").css("width","0%");        
        $url = $(this).attr("widgitize");
        
        $.get($url,function(data){                       
            
            $(obj).find(".progress-bar").css("width","95%");                    
            $(obj).append(data);                                    
            $(obj).find(".progress-bar").css("width","99%");
            
            setTimeout(function(){
                
                $(obj).find('form').on( "submit", function( event ) {                    
                    
                    event.preventDefault();
                    event.stopPropagation();
                    
                    widgetSubmitHandeler(this); 
                    return false;
                });
                
                $(obj).find(".progress").remove();
                
            },800);            
            
        });
    });
    
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "100",
    "hideDuration": "500",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };

    
}
function widgetSubmitHandeler(form)
{       
        
        $url = $(form).attr('action');
        $method = $(form).attr('method');        
        $data = new FormData(form);
        
        $(form).prop('disabled', 'disabled');
        $(form).find("input").prop('disabled', 'disabled');        
        
        $.ajax({type:$method, url: $url, 
            data: $data,  
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(response) {
                
                
                $parent = $(form).parent("[data-toggle='dataWidgets']");                
                
                $parent.html(response);                
                
                $($parent).find('form').on( "submit", function( event ) {                    
                    
                    event.preventDefault();
                    event.stopPropagation();
                    
                    widgetSubmitHandeler(this); 
                    return false;
                });

            },
            error: function(jqXHR , textStatus, errorThrown) {

                $(form).parent("[data-toggle='dataWidgets']").html(textStatus);            
            }
        });
        
        return false;
}
function initModalForms()
{
    $('[data-toggle="ajaxModal"]').on('click',
        function(e){
            e.preventDefault();
            $("#ajaxModal").remove();            
            $(".modal-backdrop").remove();            
            
            var $this=$(this);
            $remote=$this.data('remote')||$this.attr('href');
            $modal=$('<div  class="modal" tabindex="-1" role="dialog" id="ajaxModal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({backdrop: 'static'});
            $modal.load($remote,function(result){
                modal_form_submit_handler();
            });
            return false;
        });                
    
}
function loadModalURL(obj)
{
            showLoader();
            $("#ajaxModal").remove();
            $(".modal-backdrop").remove();
            
            var $this=$(obj);
            $remote=$this.data('remote')||$this.attr('remote');
            $modal=$('<div  class="modal" tabindex="-1" role="dialog" id="ajaxModal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({backdrop: 'static'});
            $modal.load($remote,function(result){
                modal_form_submit_handler();
                hideLoader();
            });
        return false;
}

function modalURL($url)
{
            $("#ajaxModal").remove();
            $(".modal-backdrop").remove();
            
            $remote=$url;
            $modal=$('<div  class="modal" tabindex="-1" role="dialog" id="ajaxModal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({backdrop: 'static'});
            $modal.load($remote,function(result){
                modal_form_submit_handler();
            });
        return false;
}

function modal_form_submit_handler()
{
     
     $('[data-ride="ajaxModalForm"]').on( "submit", function( event ) {
                
        event.preventDefault();
        event.stopPropagation();
        
        $url = $(this).attr('action');
        $method = $(this).attr('method');
        //$data = $(this).serialize();
        $data = new FormData(this);
        $data.append(GVSubmitActor.name,GVSubmitActor.value);
        $(this).prop('disabled', 'disabled');
        $(".modal-dialog").hide();
        showLoader();
        $.ajax({type:$method, url: $url, 
            data: $data,  
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(response) {
                hideLoader();
                if(response.js != undefined) {                                
                    $('[data-dismiss="modal"]').click();                                    
                    if(response.js != "") {
                        eval(response.js);
                    }else{
                        toastr["success"]("operation successful", "");
                    }
                }
                if(response.redirect) { 
                    $('[data-dismiss="modal"]').click();
                    toastr["success"]("Redirecting..", "");
                    setTimeout(function(){
                        window.location = response.redirect;
                    },250);
                    
                }
                if(response.toast) { 
                    $('[data-dismiss="modal"]').click();
                    toastr["success"](response.toast, "");
                    if(response.func != "")
                    {
                        eval(response.func);
                    }
                    else {
                        setTimeout(function(){
                            window.location.reload();
                        },400);
                    }
                    
                }
                if(response == "") { 
                    $('[data-dismiss="modal"]').click();
                    toastr["success"]("operation successful .. refreshing", "");
                    setTimeout(function(){
                        window.location.reload();
                    },250);
                    
                }
                else {

                    $("#ajaxModal").html(response);                
                    modal_form_submit_handler();
                }

        },
            error: function(jqXHR , textStatus, errorThrown) {

            $(".modal-body").html(textStatus);            
            $('[data-ride="ajaxModalForm"] .modal-footer').hide();
        }
        });
        
        return false;

    });
    
    $('[data-ride="ajaxModalForm"] [type="submit"]').click(function(){
        GVSubmitActor.name = this.name;
        GVSubmitActor.value = this.value;        
//        $(this).text("Please Wait..");
//        $(this).prop('disabled', 'disabled');
//        $(this).parents('form').submit();
//        
    });
        
    // ReMap Events Controls
    uiManager(".modal ");        
           
}

function uiManager($context)
{    
    $($context + '.datepicker').each(function(obj,idx){
        
        $attr = $(this).attr("direction");
        if($attr == "past")
        {
            $(this).datepicker({ dateFormat: 'dd/mm/yy' ,maxDate: 0});
        }
        else if($attr == "future")
        {
            $(this).datepicker({ dateFormat: 'dd/mm/yy' ,minDate: 0});
        }
        else if($attr == "range")
        {
            $max = $(this).attr("dmax");
            $min = $(this).attr("dmin");                        
            
            $(this).datepicker({ dateFormat: 'dd/mm/yy' ,
                minDate: $min,
                maxDate: $max,                                
            });
        }
        else{
            $(this).datepicker({ dateFormat: 'dd/mm/yy' });
            
        }        
        
    });
        
    $($context + '.timepicker').each(function(obj,idx){
        $(this).timepicker({
            minuteStep : 15
        });
    });
    
    $('.timepicker').on('keydown', function(e){
        var code = e.keyCode || e.which;
        if (code == '9') {
            $(this).timepicker('hideWidget');
        }
    });
    
    $($context +' .form-control').first().focus();
    
    LocationAutoComplete($context);
    CommonAutoComplete($context);
    
    $($context +'input[datachange]').change(function(){
        
        showLoader();
        $form = $(this).parents('form:first');
        $func = $(this).attr('datachange');
        
        $data = $($form).serialize();        
        
        $url = $($form).attr('action');
        $.ajax({type:"GET", url: $url, 
            data: $data+"&datachange="+$func,  
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(response) {
                hideLoader();
                $f = window[$func];
                $f(response);

            },
            error: function(jqXHR , textStatus, errorThrown) { alert(textStatus); }
        });
        
    });
    
    $($context +'select[datachange]').change(function(){
        
        $form = $(this).parents('form:first');
        $func = $(this).attr('datachange');
        
        $data = $($form).serialize();        
        
        $url = $($form).attr('action');
        $.ajax({type:"GET", url: $url, 
            data: $data+"&datachange="+$func,  
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(response) {
                
                $f = window[$func];
                $f(response);

            },
            error: function(jqXHR , textStatus, errorThrown) { alert(textStatus); }
        });
        
    });
    
    
    
     //advance multiselect start
    $($context +' .multi-select').multiSelect({
        selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        keepOrder: true,
        afterInit: function (ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function (e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function (e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function (value) {
            // this.qs1.cache();
            // this.qs2.cache();
            $($context +' .multi-select option[value="'+value+'"]').remove();
            $($context +' .multi-select').append($("<option></option>").attr("value",value).attr('selected', 'selected'));
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    $($context +' select').not('.multi-select').each(function(){
        $(this).select2();
    });

    
    RegisterMediaManager();
        
    
    return true;
}



function notifyMe($title,$msg,$url) {
    if (Notification.permission !== "granted")
        Notification.requestPermission();
    else {
        var notification = new Notification($title, {
            icon: $base_url + 'public/assets/images/fixsys48.png',
            body: $msg,
        });

        notification.onclick = function () {
            if($url != ""){
                window.open($url);
            }
        };

    }
}

function findinString($find,$pool)
{   
    var stringArray = $pool.split(',');       
    for (var i=0; i<stringArray.length; i++) {
        if (stringArray[i].match($find)) {
             return true;
        }
    }
    return false;
}

String.prototype.lpad = function(padString, length) {
    var str = this;
    while (str.length < length)
        str = padString + str;
    return str;
}

function LocationAutoComplete($context)
{
    $($context + '[datatoggle="locationAutoComplete"]').each(function(idx, obj){
        
        $name = $(this).attr("name");
        $autoComplete = $(this).clone();
        $($autoComplete).attr("name","LocationAutoComplete_"+$name);
        $($autoComplete).attr("id","LocationAutoComplete_"+$name)
        $($autoComplete).attr("sudoname",$(this).attr('id'));
        $($autoComplete).removeAttr('datatoggle');
        $($autoComplete).val($(this).attr("sudovalue"));
        if($(this).attr("sudovalue") != "") {
            $($autoComplete).attr("optSelected","true");
        }
        $(this).attr("type","hidden");
        $(this).parent().append($autoComplete);
        
        $($autoComplete).autocomplete({ source: $locationUrl,
        minLength: 2,
        search : function(){
            $(this).attr("optSelected","false");
        },
        select: function( event, ui ) {        
            
            $(this).val(ui.item.label);
            $id = $(this).attr("sudoname");
            $("#"+$id).val(ui.item.id);            
            $(this).attr("optSelected","true");
            return false;
            },
        focus: function(event, ui) {
            $(this).val(ui.item.label);
            return false;
        },
        });
        
        // When nothing is selected
        $($autoComplete).on("blur",function(){              
            $selected = $(this).attr("optSelected");            
            if($selected != "true")
            {
                $(this).val("");
                $id = $(this).attr("sudoname");
                $("#"+$id).val("");            
                
            }
        });
        
    });
}

function CommonAutoComplete($context)
{
    $($context + '[datatoggle="CommonAutoComplete"]').each(function(idx, obj){
        
        $url = $(this).attr("href");
        $name = $(this).attr("name");
        $autoComplete = $(this).clone();
        $($autoComplete).attr("name","CommonAutoComplete_"+$name);
        $($autoComplete).attr("id","CommonAutoComplete_"+$name)
        $($autoComplete).attr("sudoname",$(this).attr('id'));
        $($autoComplete).attr("autocomplete","false");
        $($autoComplete).removeAttr('datatoggle');
        $($autoComplete).val($(this).attr("sudovalue"));
        if($(this).attr("sudovalue") != "") {
            $($autoComplete).attr("optSelected","true");
        }
        $(this).attr("type","hidden");
        $(this).parent().append($autoComplete);
        
        $($autoComplete).autocomplete({ source: $url,
        minLength: 2,                        
        search : function(){
            $(this).attr("optSelected","false");
        },
        select: function( event, ui ) {        
            
            $(this).val(ui.item.label);
            $id = $(this).attr("sudoname");
            $("#"+$id).val(ui.item.id);            
            $(this).attr("optSelected","true");
            return false;
            },
        focus: function(event, ui) {
            $(this).val(ui.item.label);
            return false;
        },        
        });
        
        // When nothing is selected
        $($autoComplete).on("blur",function(){              
            $selected = $(this).attr("optSelected");            
            if($selected != "true")
            {
                $(this).val("");
                $id = $(this).attr("sudoname");
                $("#"+$id).val("");            
                
            }
        });
        
    });
}

function propelDate($val,$type=0)
{    
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $d = new Date($val);
    if($type == 0) {
        //return $d.toLocaleString();
        $ampm = "AM";
        $hours = $d.getHours();
        
        if($hours == 12)
        {
            $hours = $hours;
            $ampm = "PM";
        }else if($hours > 12){
            $hours = $hours-12;
            $ampm = "PM";
        } else if($hours == 0){
            $hours = 12;
        }
        return  $d.getDate() + '/' + ($d.getMonth() + 1) + '/' +  $d.getFullYear() + " " + $hours + ":" +  ('0'+$d.getMinutes()).slice(-2)+" "+$ampm;
         
    }
    
    if($type == "1") {
        return  $d.getDate() + '/' + ($d.getMonth() + 1) + '/' +  $d.getFullYear();
        //return $d.toLocaleDateString();
    }
    else if($type == "2") {
        
        return  monthNames[($d.getMonth())] + ' - ' +  $d.getFullYear();
        //return $d.toLocaleDateString();
    }
    else{
        return  monthNames[($d.getMonth())] + '-' +  $d.getFullYear();
        //return $d.toLocaleDateString();
    }
}

function CallBackMobilePar(key,func) {
            setTimeout(function(){
                if($isApp) {                
                var value = {Type: key,CallBack:func};
                var jsonString = (JSON.stringify(value));
                var escapedJsonParameters = escape(jsonString);
                var appName = 'ArchisysWeb';            

                var url = appName + '://' + key + "#" + escapedJsonParameters;
                document.location.href = url;
            }
            },1000);
            
        }

function setIsApp()
{ 
    $isApp = true;
    
}

function quickPost($url,$data,$func)
{  showLoader();
    $.ajax({
        type: "POST",
        url: $url,
        data: $data,
        dataType: "json",
        success: function(data) 
        {  hideLoader();
            $func(data);
    },
    error: function() {
        alert('error handing here');
    }
    });
}

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function datatableCheckboxManager($datatable)
{
     // Handle click on "Select all" control
   $('.datatableCheckbox').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = $datatable.fnGetNodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
   
   // Handle click on checkbox to set state of "Select all" control
   $('.nodeCheckbox').on('click', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('.datatableCheckbox').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
       
}

function hideLoader()
{
    $('#preloader').fadeOut('slow');    
}
function showLoader()
{
    $('#preloader').show();
}

function RegisterMediaManager()
{
    $(".mediaManagerBtn").click(function(e){
             
        e.preventDefault();
        $("#MediaModal").remove();            
        $(".modal-backdrop").remove();            

        var $this=$(this);
        $remote=$this.data('remote')||$this.attr('href');
        $modal=$('<div class="modal" tabindex="-1" role="dialog" id="MediaModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal({backdrop: 'static'});
        
        $modal.load($remote,function(result){
            //modal_form_submit_handler();
        });
        
        return false;      
        
    });
    
}

