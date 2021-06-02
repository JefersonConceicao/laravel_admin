$(function(){
    habilitaBotoes();
    habilitaEventos();
});

const grid = "#gridSetores";
const modalObject = "#nivel1";

const changeTitle = function(){
    document.title = 'BT | Setores';
}

const habilitaEventos = function(){
    $("#formSearchSetores").on("submit", function(e){
        e.preventDefault();
        getSetoresFilter();
    })
}

const habilitaBotoes = function(){
    $(grid + " .pagination > li > a").on("click", function(e){
        e.preventDefault();

        const url = $(this).attr("href");
        if(!!url){
            getSetoresFilter(url);
        }
    })


    AppUsage.deleteMultipleRowsHelper(grid, function(){
        $(".deleteALL").on("click", function(){
            const url = '/setores/deleteAll'
            const ids = $("tr.row-selected").map(function(index, element){
                return $(element).attr("key");
            });

            AppUsage.deleteMultipleRowsGrid(url, ids, function(){
                getSetoresFilter();  
            })
        });
    })

    $("#addSetor").on("click", function(){
        const url = '/setores/create';

        AppUsage.loadModal(url, modalObject, '60%', function(){
            $("#addFormSetor").on("submit", function(e){
                e.preventDefault();

                formSetor();
            })
        });
    });

    $(".btnEditSetor").on("click", function(){
        const id = $(this).attr("id");
        const url = '/setores/edit/' + id;

        AppUsage.loadModal(url, modalObject, '60%', function(){
            $("#editFormSetor").on("submit", function(e){
                e.preventDefault();

                formSetor(id);
            })
        });
    })  

    $(".btnDeleteSetor").on("click", function(){
        const id =  $(this).attr("id");
        const url = '/setores/delete/' + id;

        Swal.fire({
            title: 'Deseja realmente excluir o registro?',
            text: 'Esta ação é irreversivel!',
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
        }).then(result => {
            if(result.isConfirmed){
                AppUsage.deleteForGrid(url, function(){
                    getSetoresFilter();
                })
            }
        })
    });
}

const getSetoresFilter = function(url){
    let form = $("#formSearchSetores").serialize();

    $.ajax({
        type: "GET",
        url: typeof url !== "undefined" ? url : "/setores/",
        data: form,
        dataType: "HTML",
        beforeSend:function(){
            AppUsage.loading($(grid));
        },
        success: function (response) {
           $(grid).html($(response).find(`${grid} >`));
            habilitaBotoes();
        }
    });
}

const formSetor = function(id){
    const url = typeof id === "undefined" ? '/setores/store' : '/setores/update/' + id;
    const type = typeof id === "undefined" ? 'POST' : 'PUT';
    const form = typeof id === "undefined" ? '#addFormSetor' : '#editFormSetor';

    $.ajax({
        type,
        url,
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend:function(){
            $(form + " .btnSubmit").prop("disabled", true).html(`
                <i class="fa fa-spinner fa-spin"> </i> Carregando...
            `)      
        },
        success: function (response) {
            Swal.fire({
                position: 'top-end',
                icon: !response.error ? 'success' : 'error',
                title: `<b style="color:#fff"> ${response.msg} </b>`,
                toast: true,
                showConfirmButton: false,
                timer: 3500,
                background: '#337ab7',
                didOpen:() => {
                   $(modalObject).modal('hide');
                }
            });
            
            getSetoresFilter()
        },
        error:function(jqXHR, textstatus, error){
            if(!!jqXHR.responseJSON.errors){
                const errors = jqXHR.responseJSON.errors;

                AppUsage.showMessagesValidator(form, errors);
            }

        },
        complete:function(){
            $(form + " .btnSubmit").prop("disabled", false).html(`
                Salvar
            `)      
        }
    });
}

module.exports = {
    changeTitle,
    habilitaEventos,
    habilitaBotoes,
}