//FUNCTION TO GET THE USERS
function getUsuarios(){
    //PEGANDO OS FILTROS
    let centro = $('#cbCentro').val();
    let departamento = $('#cbDepartamento').val();
    let token = $('input[name=_token]').val();

    //CLEANING
    $('tbody').empty();

    //AJAX CALL
    $.ajax({
        url: '/getUsuarios',
        method: "GET",
        data: {
            centro: centro,
            departamento: departamento,
            _token: token
        },
        dataType: "JSON",
        success: function (resp){
            if(resp.code === 200){
                $.each(resp.body, function (index, user){
                    $('tbody').append("<tr>" +
                            "<td>"+user.name+"</td>" +
                            "<td>"+user.cargo.nome+"</td>" +
                        "</tr>")
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

//FUNCTION TO GET DEPRATAMENTOS BASED ON CENTRO DE CUSTO
function getDepartamentos(centro){
    //CLEANING
    $('#cbDepartamento').find('option[value!=0]').remove();

    //AJAX CALL
    $.ajax({
        url: '/getDepartamentos',
        method: "GET",
        data: {
            centro: centro
        },
        dataType: "JSON",
        success: function (resp){
            if(resp.code === 200){
                $.each(resp.body, function (index, dep){
                    $('#cbDepartamento').append(
                        "<option value='"+dep.id+"'>"+dep.nome+"</option>"
                    );
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


//ON READY RUN...
$(function (){
    getUsuarios();
    getDepartamentos(0);

    //ADD FUNCTION ON CHANGE OF CENTRO
    $('#cbCentro').on('change', function (){
        getDepartamentos($(this).val());
    });
});