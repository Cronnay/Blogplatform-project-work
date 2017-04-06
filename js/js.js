$(document).ready(function() {
	$('#skapa-konto').validate({ //Validerings plugin. Går igenom vissa krav och skriver ut felmeddelande ifall det inte följer reglerna.
		rules: {
			email: {
				required: true, //kräver email, och att det är email. Så den validerar ifall det är en korrekt email.
				email: true
			},
			namn: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			pass_again: {
				required: true,
				equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "Du måste skriva in din email.",
				email: "Skriv en riktig email"
			},
			namn: {
				required: "Du måste skriva dit ett namn",
				minlength: "Det måste vara minst 2 bokstäver." //Inte sant, kan vara 2 tecken. Däremot kommer vi trimma och fixa det i php sen.
			},
			password: {
				required: "Du måste skriva dit ett lösenord.",
				minlength: "Det måste vara minst 5 tecken."
			},
			pass_again: {
				required: "Du måste skriva dit lösenordet igen.",
				equalTo: "Det måste vara samma som det övre."
			}
		},
		submitHandler: function(form) { //om den godkänds, så blir formuläret skickat, och det blir ett ajaxanrop
			var email = $('#email').val();
			var namn = $('#namn').val();
			var pass = $('#password').val();

			var user = '[{"email":"'+email+'","namn":"'+namn+'","pass":"'+pass+'"}]';

				$.ajax({
					url: "ajax/create.php",
					global: false,
					type: 'get',
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					data: {'user':user},
					success: function(data){
						if(data == "ok") //ifall data är "ok" så skrivs det ut en paragraph och sedan blir man förflyttad
						{
							$("#skapa-konto").after("<p class='approved'>Kontot skapat! Du blir skickad till framsidan om 2 sekunder.</p>");
							setTimeout(function() { document.location.href = "index.php";},2000);
						}
						else
						{
							$("#skapa-konto").after("<p class='error'>Det finns redan ett konto med den eposten.</p>");
						}
					},
					error: function(data){
						console.log(data);
					}
				});
		}
	});

	$('#login-form').validate({
		rules: {
			email: {
				email: true,
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			email: {
				email: "Skriv in en riktig email.",
				required: "Du måste skriva dit en email"
			},
			password: {
				required: "Du måste skriva dit ett lösenord"
			}
		},
		submitHandler: function(form){
			var email = $('#email').val();
			var pass = $('#password').val();

			var user = '[{"email":"'+email+'","pass":"'+pass+'"}]';

				$.ajax({
					url: "ajax/login.php",
					global: false,
					type: 'get',
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					data: {'user':user},
					success: function(data){
						if(data == "no") //Kommer endast att returnera ett nej. Om login uppfyller kraven så kommer sidan att refresha
						{
							$(".error-msg").text("Fel lösenord eller e-post. Försök igen.");
							$(".error-msg").show();
						}
						else{
							location.reload();
						}
					},
					error: function(data){
						console.log(data);
					}
				});
		}
	});

	$('#add-post').validate({
		rules: {
			titel: {
				required : true,
				minlength : 3
			},
			text: "required"
		},
		messages: {
			titel: {
				required: "Du måste ha en titel",
				minlength: "Minst 3 tecken"
			},
			text: {
				required: "Du måste skriva något i inlägget."
			}
		}
	});

	$('.delete').on("click", function(event) {
		event.preventDefault();
		var pappaid = $(this).parent().attr('id');
		var json = '[{"id":"'+pappaid+'"}]';

		var confirm = window.confirm("Vill du ta bort det här inlägget?");
		if(confirm){

			$.ajax({
				url: "ajax/delete.php",
				global: false,
				type: "get",
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				data : {
					'id' : json
				},
				success: function(data){
					$('#'+pappaid).fadeOut(300, function() {
						$(this).remove();
					});
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});
	$('.edit').on("click", function(event) {
		event.preventDefault();
		var pappaid = $(this).parent().attr('id');
		$('#' + pappaid).submit();
	});
});
