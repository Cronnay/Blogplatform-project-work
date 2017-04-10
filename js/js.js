$(document).ready(function() {
	$('#skapa-konto').validate({ //Validerings plugin. Går igenom vissa krav och skriver ut felmeddelande ifall det inte följer reglerna.
		rules: {
			email: {
				required: true, //kräver email, och att det är email. Så den validerar ifall det är en korrekt email.
				email: true //Kollar så att den är ett mail. kräver att den har ett @ och liknande
			},
			namn: {
				required: true,
				minlength: 2 //minst 2 tecken långt
			},
			password: {
				required: true,
				minlength: 5
			},
			pass_again: {
				required: true,
				equalTo: "#password" //måste vara samma lösenordet tidigare angivet
			}
		},
		messages: { //Detta är felmeddelande, som dyker upp ifall användaren har gjort något fel.
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

			var user = '[{"email":"'+email+'","namn":"'+namn+'","pass":"'+pass+'"}]'; //json-filen

				$.ajax({
					url: "ajax/create.php",
					global: false,
					type: 'get',
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					data: {'user':user},
					success: function(data){ //om det är godkänt
						if(data == "ok") //ifall data är "ok" så skrivs det ut en paragraph och sedan blir man förflyttad
						{
							$("#skapa-konto").after("<p class='approved'>Kontot skapat! Du blir skickad till framsidan om 2 sekunder.</p>");
							setTimeout(function() { document.location.href = "index.php";},2000); //om två sekunder skickas användaren vidare
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

	$('#login-form').validate({ //validering för att logga in
		rules: { //reglerna. Kräver ett lösenord och epost
			email: {
				email: true,
				required: true
			},
			password: {
				required: true
			}
		},
		messages: { //felmeddelande
			email: {
				email: "Skriv in en riktig email.",
				required: "Du måste skriva dit en email"
			},
			password: {
				required: "Du måste skriva dit ett lösenord"
			}
		},
		submitHandler: function(form){ //ifall den godkänns skickas förmuläret ut
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
							location.reload(); //refresh
						}
					},
					error: function(data){
						console.log(data);
					}
				});
		}
	});

	$('#add-post').validate({ //skapa ett inlägg
		rules: {
			titel: {
				required : true,
				minlength : 3
			},
			text: {
				required: true,
				maxlength: 2000
			}
		},
		messages: {
			titel: {
				required: "Du måste ha en titel",
				minlength: "Minst 3 tecken"
			},
			text: {
				required: "Du måste skriva något i inlägget.",
				maxlength: "Endast 1000 tecken"
			}
		}
	});

	$('.delete').on("click", function(event) { //Om användare vill ta bort sitt inlägg, så reagerar den när den klickar på klassen delete
		event.preventDefault();
		var pappaid = $(this).parent().attr('id'); //Få reda på ID till inlägget.
		var json = '[{"id":"'+pappaid+'"}]';

		var confirm = window.confirm("Vill du ta bort det här inlägget?"); //bekräfta om användaren verkligen vill, eller om det var ett misstag
		if(confirm){ //om det är ett ja, så anropas ett ajax-anrop

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
					$('#'+pappaid).fadeOut(300, function() { //Den försvinner med lite design
						$(this).remove();
					});
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$('#byta-pass').validate({ //Byta lösenord
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				pass_again: {
					required: true,
					equalTo: '#password'
				}
			},
			messages: {
				password: {
					required: "Du måste skriva dit ett lösenord",
					minlength: "Minst 5 tecken"
				},
				pass_again: {
					required: "Du måste skriva ett lösenord igen",
					equalTo: "Det stämmer inte med ovan"
				}
			},
			submitHandler: function(form, event){
				event.preventDefault(); //För att designa det lite bättre, valde jag att spärra submit, för att ta fram en popup.
				$('.container').append('<div id="myModal" class="modal"> ' + '<div class="modal-content">' + '<p>Du har bytt lösenord. Du blir omdirigerad om <b class="countdown">3</b></p></div></div>'); //Popupen

				$('#myModal').show(); //#mymodal har display: hidden till en början.
				var update = function(){ //en countdown
					$('.countdown').each(function() {
							var count = parseInt($(this).html());
							if(count !== 0){
								$(this).html(count-1);
							}
					});
				};
				setInterval(update, 1000); //sänker värder varje sekund
				setTimeout(function() { form.submit(); }, 2500); //Efter 2.5 sekunder så skickas förmuläret, och användaren refreshas
			}
	});

	$('#byta-namn').validate({ //byta namn validator
		rules: {
			namn: {
				required: true,
				minlength: 2
			}
		},
		messages: {
			required: "Om du ska byta namn måste du ange ett nytt",
			minlength: "Minst två bokstäver"
		},
		submitHandler: function(form, event){
			event.preventDefault();//För att designa det lite bättre, valde jag att spärra submit, för att ta fram en popup.
			$('.container').append('<div id="myModal" class="modal"> ' + '<div class="modal-content">' + '<p>Du har bytt namn. Du blir omdirigerad om <b class="countdown">3</b></p></div></div>'); //popupen
			$('#myModal').show(); //#mymodal har display: hidden till en början.


			var update = function(){ //en countdown
				$('.countdown').each(function() {
						var count = parseInt($(this).html());
						if(count !== 0){
							$(this).html(count-1);
						}
				});
			};
			setInterval(update, 1000); //sänker värder varje sekund
			setTimeout(function() { form.submit(); }, 2500); //Efter 2.5 sekunder så skickas förmuläret, och användaren refreshas
		}
	})

});
