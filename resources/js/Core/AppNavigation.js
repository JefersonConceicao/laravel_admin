$(function(){
    setOptionsMenu();
    setOptionsSubMenu();
})

const listMenu = $('.main-sidebar > .sidebar > .sidebar-menu > li');
const listMenuGroups = $('.main-sidebar > .sidebar > .sidebar-menu > li.treeview > .treeview-menu > li > a').addClass('targetSubMenu');
                
const setOptionsMenu = function(){
    listMenu.on('click', function(e){
        e.preventDefault();

        if(!$(this).hasClass('treeview')){
            let url = $(this).find('a').attr('href');
            let module = $(this).find('a').attr('module');

            setActive($(this));
            getNewScreen(url, module);
        }
    })
}

const setOptionsSubMenu = function(){
    listMenuGroups.on('click', function(e){
        let url = $(this).attr('href');
        let module = $(this).attr('module');

        setActive($(this));
        getNewScreen(url, module);
    })
}

const setActive = function(element){
    //VERIFICA E REMOVE QUALQUER LI ATIVA
    let liSubMenu = listMenuGroups.parent();

    if(liSubMenu.hasClass('active')){
        liSubMenu.removeClass("active");
    }

    if(listMenu.hasClass("active")){
        listMenu.removeClass("active")
    }

    if(element.is('li')){
        element.addClass("active")
    }else{
        element.parent().addClass("active");
    }
}

const loadingNavigation = function(inicio, fim, isComplete = false){
    //Calcula tempo de carregamento;
    const msTimeLoading = fim - inicio; 

    //Configura container body
    $('body').removeClass("fixed");
    $("#containerLoadingBar").show(); //Inicia barra de carregamento

    let progressBar = $("#progressLoadingBar");
    let width = !isComplete ? 1 : 93;

    let idInterval = setInterval(function(){
        if(width >= 100){
            clearInterval(idInterval);  
            width = 1;
            
            $("#containerLoadingBar").hide(); 
            $('body').addClass('fixed');
        }else{
            width++
            progressBar.css({
                width:`${width}%`,
                backgroundColor: width > 80 ? '#337ab7' : '#e91313'  
            })

            if(!isComplete && width == 93){
                clearInterval(idInterval);
            }

            if(isComplete){
                width++;
            }
        }
    }, msTimeLoading)   
}

const getNewScreen = function(url, module){
    const elementWrapper = $('.content-wrapper');

    $.ajax({
        type: "GET",
        url,
        dataType: "HTML",
        start_time: new Date().getTime(),
        beforeSend:function(jqXHR, settings){
            loadingNavigation(this.start_time, new Date().getTime());
        },
        success: function (response) {
            changeURL(url);

            elementWrapper.html(response);
            AppUsage.initializeDataTable();
            AppUsage.loadLibs();

            if(module != "no_module"){
                modulo = require('../Logged/'+module);

                if(!!modulo.habilitaBotoes && !!modulo.habilitaEventos){
                    modulo.habilitaBotoes();
                    modulo.habilitaEventos();
                }
            }
        },
        error:function(err){
            console.log(err);
        },
        complete:function(){
       
            //console.log(this);
            loadingNavigation(this.start_time, new Date().getTime(), true);
        },
    });
}

const changeURL = function(url){ //void
    history.pushState({}, "", url);
}

module.exports = {
    setOptionsSubMenu,
    loadingNavigation,
}