//SUBMIT FUNCTION TO SAVE AN ELEMENT
$('.btnSave').on('click', function (){
    //FORM DATA
    let form = $(this).closest("form");
    if(!form.valid()){
        Swal.fire("Erro", "Existem campos não preenchidos", "error");
        return false;
    }
    let endpoint = form.attr('action');
    let after = form.data("after");
    let data = new FormData(form[0]);
    let object = {};
    data.forEach((value, key) => object[key] = value);

    //AJAX CALL
    $.ajax({
        url: endpoint,
        method: "POST",
        dataType: "JSON",
        data: object,
        success: function (resp){
            if(resp.code === 200){
                Swal.fire("Salvo com sucesso", "", "success").then(() => {
                    if(after === "home"){
                        location.href = "/"
                    }else if(after === "reload"){
                        location.reload();
                    }
                });
            }else{
                Swal.fire("Erro", "Houve um erro", 'error');
            }
        },
        error: function (){
            Swal.fire("Erro", "Houve um erro não mapeado", 'error');
        }
    });
});

//FUNCTION TO DELETE AN ELEMENT
$('.btnDel').on('click', function (){
    Swal.fire({
        title: "Você tem certeza?",
        text: "Essa ação não pderá ser desfeita.",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonText: "Sim"
    }).then((value) => {
        if(value.value){
            //FORM DATA
            let form = $(this).closest("form");
            let tipo = form.data('tipo');
            let id = form.find('#id').val();
            let token = form.find('input[name=_token]').val();
            let after = form.data("after");

            //AJAX CALL
            $.ajax({
                url: "/delete/"+tipo+"/"+id,
                method: "DELETE",
                dataType: "JSON",
                data: "_token="+token,
                success: function (resp){
                    if(resp.code === 200){
                        Swal.fire("Removido com sucesso", "", "success").then(() => {
                            if(after === "home"){
                                location.href = "/"
                            }else if(after === "reload"){
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire("Erro", "Houve um erro", 'error');
                    }
                },
                error: function (){
                    Swal.fire("Erro", "Houve um erro não mapeado", 'error');
                }
            });
        }
    });
});

//FUNTION TO IMPORT USERS
$('#btnImportar').on('click', function (){
    Swal.fire('Importando usuários...');
    Swal.showLoading();
    //AJAX CALL
    $.ajax({
        url: '/importar',
        method: "POST",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        data: new FormData($('#frmImportador')[0]),
        success: function (resp){
            if(resp.code === 200){
                Swal.fire("Importado com sucesso", "", "success").then(() => {
                    location.reload();
                });
            }else{
                Swal.fire("Erro", "Houve um erro", 'error');
            }
        },
        error: function (){
            Swal.fire("Erro", "Houve um erro não mapeado", 'error');
        }
    });
})