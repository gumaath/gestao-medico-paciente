$(document).ready(function($) {
    $('#cpf').mask('000.000.000-00', {
        reverse: true
    });
    $('#responsable_cpf').mask('000.000.000-00', {
        reverse: true
    });
    $('#cep').mask('00000000', {
        reverse: true
    });
    $('#telephones').mask('(99) 9 9999-9999, (99) 9 9999-9999, (99) 9 9999-9999');

});

// Function to update the #address field
function updateAddressField(cep, number) {
    var addressElement = $('#address');
    $('#address').val('...');

    axios.get("https://viacep.com.br/ws/" + cep + "/json/")
        .then(response => {
            if (response.data.logradouro) {
                $('#address').val(response.data.logradouro + ', ' + number + ' - ' + response.data.localidade +
                    ' - ' + response.data.uf);
            } else if (response.data.erro) {
                addressElement.val('');
                alert('Insira um CEP válido!');
            }
        })
        .catch(error => {
            // Handle any network or other errors
            addressElement.val('');
            alert('Insira um CEP válido!');
        });;
}

// Event listener for #CEP blur
$('#cep').blur(function() {
    if ($(this).val().length == 8) {
        var cep = $(this).val().replace(/\D/g, '');
        var number = $('#number_address').val();

        updateAddressField(cep, number);
    }
});

// Event listener for #number_address
$('#number_address').blur(function() {
    var cep = $('#cep').val().replace(/\D/g, '');
    var number = $(this).val();

    updateAddressField(cep, number);
});

// Event listener for #birthdate
$('#birthdate').change(function() {
    var birthdate = new Date($(this).val());
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();

    if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today
            .getDate() < birthdate.getDate())) {
        age--;
    }

    // Check if the patient is under 12 years old
    if (age < 12) {
        // Show the Responsable CPF and Name fields
        $('#responsable-cpf-field').show();
        $('#responsable-name-field').show();
    } else {
        // Hide the Responsable CPF and Name fields
        $('#responsable-cpf-field').hide();
        $('#responsable-name-field').hide();
    }
});
