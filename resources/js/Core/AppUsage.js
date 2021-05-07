$(function(){
    initializeDataTable();
    loadLibs();
})

const initializeDataTable = function(){
    $(".dataTable").dataTable({
        buttons:[
            'pdf',
        ],
        paging: false,
        searching: false,
        language: languageDataTable.portugues,
    });  
}

const loadLibs = function(){
    configSelect2();
    configMultiSelect();
    configDropzone();
}

/**
 * 
 * @param {string} url 
 * @param {element} modalObject 
 * @param {string} width pixels 
 * @param {callback} callback função a ser executada dentro do modal
 */

const loadModal = function(url, modalObject, width = null, callback = null){
    $(modalObject).modal({ backdrop: 'static'}); //EVITA QUE O MODAL FECHE AO CLICAR FORA DO ESCOPO DO MODAL
    $(modalObject).find('.modal-dialog').css({
        width: !!width ? width : '800px'
    });

    $(modalObject).find('.modal-content').html("").append(
        `<section>  
            <div class="alert alert-primary"> <i class="fa fa-spinner fa-spin"> </i> Carregando... <div>
        </section>`
    );
           
    $(modalObject).find(`.modal-content`).load(`${url} ${modalObject} > .modal-dialog > .modal-content >`, function(){
        //Executa novamente loadLibs para novo HTML 
        loadLibs();

        if(!!callback){
            callback();
        }
     }) 
}

//PARAM - ELEMENTO A SER REMOVIDO PARA INSERÇÃO DO LOADING
const loading = function(element){
    element.closest(element).html(`
        <div class="alert alert-danger">
            <div class="text-center">    
                <b> 
                    <i 
                        class="fa fa-circle-o-notch fa-spin" aria-hidden="true"
                        style="font-size:30px;"
                    >  
                    </i>   
                </b>
            </div>
        </div>
    `)
}

const configMultiSelect = function(){
    $(".multiselect").multiSelect({
        selectableHeader: `<input type="text" 
                            class="form-control" 
                            autocomplete="off" 
                            placeholder="Pesquise..." 
                        />`,

        selectionHeader: `<input 
                            type="text"
                            class="form-control" 
                            autocomplete="off" 
                            placeholder="Pesquise..." 
                        />`,

        afterInit:function(ms){
            var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
                if (e.which === 40){
                    that.$selectableUl.focus();
                    return false;
                }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
                if (e.which == 40){
                    that.$selectionUl.focus();
                    return false;
                }
            });
        },

        afterSelect:function(e){
            this.qs1.cache();
            this.qs2.cache();     
        },

        afterDeselect:function(){
            this.qs1.cache();
            this.qs2.cache();
        },
    });
}

const configSelect2 = function(){
    $(".select2").select2({   
        language:'pt-BR',
        placeholder: 'Selecione uma opção',
        allowClear:true,
        width:'100%',
    });  
}

/**
 * 
 * @param {Object} params 
 */
const configDropzone = function(params){
    Dropzone.options.myDropzone = {
        
    }
}

const showMessagesValidator = function(form, errorsRequest){
    if(form.length == 0){
        return;
    }   

    $('.error_feedback').html("");
    let fields = Object.keys(errorsRequest);
                    
    for(i=0; i < fields.length; i++){
        let input = $(`${form} input[name="${fields[i]}"]`);
        let select = $(`${form} select[name="${fields[i]}"]`);
        let textArea = $(`${form} textarea[name="${fields[i]}"]`);
   
        if(!!input){
            errorsRequest[fields[i]].forEach(value => {
                input.parent().find('.error_feedback').html(
                    `<p style="color:red;"> ${value} </p>`
                );
            })
        }

        if(!!select){
            errorsRequest[fields[i]].forEach(value => {
                select.parent().find('.error_feedback').html(
                    `<p style="color:red;"> ${value} </p>`
                );
            }) 
        }   

        if(!!textArea){
            errorsRequest[fields[i]].forEach(value => {
                textArea.parent().find('.error_feedback').html(
                    `<p style="color:red;"> ${value} </p>`
                );
            }) 
        }
    }    
}

/**
 * 
 * @param {string} url 
 * @param {callback} onSuccess 
 * @param {callback} onError 
 */

const deleteForGrid = function(url, onSuccess = null, onError = null){
    $.ajax({
        method: "DELETE",
        url, 
        beforeSend:function(){
            
        },
        success:function(response){
            Swal.fire({
                position: 'top-end',
                icon: !response.error ? 'success' : 'error',
                title: `<b style="color:#fff"> ${response.msg} </b>`,
                toast: true,    
                showConfirmButton: false,
                timer: 3500,
                background: '#337ab7',
                iconColor: !response.error ? '#ffff' : 'red',
            })     

            if(!!onSuccess && !response.error){
                onSuccess();
            }  
            
        },
        error:function(jqXHR, textStatus, errorThrown){
        let msg = "Não foi possível excluir o registro, tente novamente mais tarde ou abra um chamado."
        
            if(!!jqXHR.responseJSON){
                let code = jqXHR.responseJSON.code

                switch (code) {
                    case "23000":
                        msg = "Não foi possível excluir este registro, pois o mesmo está sendo utilizado";
                        break;
                
                    default:
                        msg = msg
                    break;
                }
            }

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: `<b style="color:#fff"> ${msg} </b>`,
                toast: true,    
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                background: '#e91313', 
                iconColor: '#ffff', 
            })

            if(!!onError){
                onError();
            }
        },
    });
}

module.exports = {
    loadModal,
    loadLibs,
    loading,
    initializeDataTable,
    showMessagesValidator,
    deleteForGrid,
    configDropzone,
}