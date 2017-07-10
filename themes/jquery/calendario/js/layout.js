(function($){
	var initLayout = function() {
		var fecha = new Date();
		var inicio=fecha.getDate() + "/" + (fecha.getMonth() +1) + "/" + fecha.getFullYear();


		$('.date').click(function(){
			var captura=$('.date').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date').val(formated);
				}
			});
		})


		$('.date0').click(function(){
			var captura=$('.date0').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date0').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date0').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date0').val(formated);
				}
			});
		})


		$('.date1').click(function(){
			var captura=$('.date1').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date1').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date1').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date1').val(formated);
				}
			});
		})


		$('.date2').click(function(){
			var captura=$('.date2').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date2').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date2').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date2').val(formated);
				}
			});
		})


		$('.date3').click(function(){
			var captura=$('.date3').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date3').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date3').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date3').val(formated);
				}
			});
		})


		$('.date4').click(function(){
			var captura=$('.date4').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date4').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date4').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date4').val(formated);
				}
			});
		})
		
		$('.date5').click(function(){
			var captura=$('.date5').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date5').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date5').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date5').val(formated);
				}
			});
		})

		$('.date6').click(function(){
			var captura=$('.date6').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date6').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date6').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date6').val(formated);
				}
			});
		})

		$('.date7').click(function(){
			var captura=$('.date7').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date7').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date7').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date7').val(formated);
				}
			});
		})


		$('.date8').click(function(){
			var captura=$('.date7').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date8').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date8').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date8').val(formated);
				}
			});
		})


		$('.date9').click(function(){
			var captura=$('.date7').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date9').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date9').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date9').val(formated);
				}
			});
		})



		$('.date10').click(function(){
			var captura=$('.date10').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date10').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date10').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date10').val(formated);
				}
			});
		})



		$('.date11').click(function(){
			var captura=$('.date11').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date11').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date11').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date11').val(formated);
				}
			});
		})



		$('.date12').click(function(){
			var captura=$('.date12').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date12').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date12').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date12').val(formated);
				}
			});
		})


		$('.date13').click(function(){
			var captura=$('.date13').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date13').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date13').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date13').val(formated);
				}
			});
		})


		$('.date14').click(function(){
			var captura=$('.date14').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date14').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date14').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date14').val(formated);
				}
			});
		})


		$('.date15').click(function(){
			var captura=$('.date15').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date15').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date15').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date15').val(formated);
				}
			});
		})


		$('.date16').click(function(){
			var captura=$('.date16').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date16').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date16').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date16').val(formated);
				}
			});
		})


		$('.date17').click(function(){
			var captura=$('.date17').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date17').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date17').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date17').val(formated);
				}
			});
		})


		$('.date18').click(function(){
			var captura=$('.date18').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date18').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date18').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date18').val(formated);
				}
			});
		})


		$('.date19').click(function(){
			var captura=$('.date19').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date19').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date19').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date19').val(formated);
				}
			});
		})


		$('.date20').click(function(){
			var captura=$('.date20').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date20').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date20').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date20').val(formated);
				}
			});
		})


		$('.date21').click(function(){
			var captura=$('.date21').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date21').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date21').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date21').val(formated);
				}
			});
		})


		$('.date22').click(function(){
			var captura=$('.date22').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date22').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date22').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date22').val(formated);
				}
			});
		})


		$('.date23').click(function(){
			var captura=$('.date23').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date23').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date23').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date23').val(formated);
				}
			});
		})


		$('.date24').click(function(){
			var captura=$('.date24').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date24').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date24').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date24').val(formated);
				}
			});
		})


		$('.date25').click(function(){
			var captura=$('.date25').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date25').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date25').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date25').val(formated);
				}
			});
		})


		$('.date26').click(function(){
			var captura=$('.date26').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date26').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date26').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date26').val(formated);
				}
			});
		})


		$('.date27').click(function(){
			var captura=$('.date27').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date27').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date27').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date27').val(formated);
				}
			});
		})


		$('.date28').click(function(){
			var captura=$('.date28').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date28').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date28').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date28').val(formated);
				}
			});
		})


		$('.date29').click(function(){
			var captura=$('.date29').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date29').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date29').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date29').val(formated);
				}
			});
		})


		$('.date30').click(function(){
			var captura=$('.date30').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date30').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date30').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date30').val(formated);
				}
			});
		})



		$('.date31').click(function(){
			var captura=$('.date31').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date31').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date31').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date31').val(formated);
				}
			});
		})


		$('.date32').click(function(){
			var captura=$('.date32').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date32').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date32').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date32').val(formated);
				}
			});
		})


		$('.date33').click(function(){
			var captura=$('.date33').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date33').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date33').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date33').val(formated);
				}
			});
		})


		$('.date34').click(function(){
			var captura=$('.date34').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date34').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date34').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date34').val(formated);
				}
			});
		})


		$('.date35').click(function(){
			var captura=$('.date35').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date35').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date35').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date35').val(formated);
				}
			});
		})


		$('.date36').click(function(){
			var captura=$('.date36').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date36').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date36').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date36').val(formated);
				}
			});
		})

				
		$('.date37').click(function(){
			var captura=$('.date37').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date37').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date37').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date37').val(formated);
				}
			});
		})
		
		$('.date37').click(function(){
			var captura=$('.date37').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date37').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date37').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date37').val(formated);
				}
			});
		})

		$('.date38').click(function(){
			var captura=$('.date38').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date38').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date38').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date38').val(formated);
				}
			});
		})

		$('.date39').click(function(){
			var captura=$('.date39').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date39').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date39').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date39').val(formated);
				}
			});
		})

		$('.date40').click(function(){
			var captura=$('.date40').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date40').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date40').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date40').val(formated);
				}
			});
		})

		$('.date41').click(function(){
			var captura=$('.date41').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date41').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date41').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date41').val(formated);
				}
			});
		})

		$('.date42').click(function(){
			var captura=$('.date42').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date42').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date42').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date42').val(formated);
				}
			});
		})

		$('.date43').click(function(){
			var captura=$('.date43').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date43').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date43').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date43').val(formated);
				}
			});
		})

		$('.date44').click(function(){
			var captura=$('.date44').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date44').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date44').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date44').val(formated);
				}
			});
		})

		$('.date45').click(function(){
			var captura=$('.date45').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date45').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date45').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date45').val(formated);
				}
			});
		})

		$('.date46').click(function(){
			var captura=$('.date46').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date46').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date46').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date46').val(formated);
				}
			});
		})

		$('.date47').click(function(){
			var captura=$('.date47').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date47').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date47').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date47').val(formated);
				}
			});
		})

		$('.date48').click(function(){
			var captura=$('.date48').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date48').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date48').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date48').val(formated);
				}
			});
		})

		$('.date49').click(function(){
			var captura=$('.date49').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date49').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date49').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date49').val(formated);
				}
			});
		})

		$('.date50').click(function(){
			var captura=$('.date50').val().trim();
			captura==""?inicio=inicio:inicio=captura;
			$('.date50').DatePicker({
				format:'d/m/Y',
				date: inicio,
				current: inicio,
				starts: 1,
				position: 'right',
				onBeforeShow: function(){
					$('#date50').DatePickerSetDate(inicio, true);
				},
				onChange: function(formated, dates){
					$('#date50').val(formated);
				}
			});
		})

	};

	EYE.register(initLayout, 'init');
})(jQuery)
