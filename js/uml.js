$(function(){
		$(bNewClass).click(creaClase);
		$(bNewAbsClass).click(creaClaseAbs);
		$(bNewInterface).click(creaInterfaz);
		$(bNewLinkG).click(creaLinkG);
		$(bNewLinkI).click(creaLinkI);
		$(bNewLinkC).click(creaLinkC);
		$(bNewLinkA).click(creaLinkA);
		$(btnClassName).click(cambiaNombreClase);
	});
  
  var graph = new joint.dia.Graph();

  var paper = new joint.dia.Paper({
      el: $('#paper'),
      width: 800,
      height: 600,
      gridSize: 1,
      model: graph
  });
  
  var paperSmall = new joint.dia.Paper({
	    el: $('#paper-small'),
	    width: 400,
	    height: 300,
	    model: graph,
	    gridSize: 1
	});
	paperSmall.scale(.5);
	paperSmall.$el.css('pointer-events', 'none');


  var uml = joint.shapes.uml;
  

  paper.on('cell:pointerdblclick', function(cellView) {

	  cellView.model.remove();
	  $(nameClass).empty();
	  $(attribs).empty();
	  $(meths).empty();
      
  });
  
  paper.on('blank:pointerclick', function(){
	  $(nameClass).empty();
	  $(attribs).empty();
	  $(meths).empty();
  });
  
  paper.on('cell:pointerclick', function(cellView) {

	  elementoActual = cellView;
	  atributos = elementoActual.model.get('attributes');
	  metodos = elementoActual.model.get('methods');
	  tamanio = elementoActual.model.get('size');
	  nombre = elementoActual.model.get('name');
	  
	  $(nameClass).empty();
	  muestraNombre();
	  $(attribs).empty();
	  muestraAttrs();
	  $(meths).empty();
	  muestraMetodos();
      
  });
  
  /*
//Here is the real deal. Listen on cell:pointerup and link to an element found below.
  paper.on('cell:pointerup', function(cellView, evt, x, y) {

      // Find the first element below that is not a link nor the dragged element itself.
      var elementBelow = graph.get('cells').find(function(cell) {
          if (cell instanceof joint.dia.Link) return false; // Not interested in links.
          if (cell.id === cellView.model.id) return false; // The same element as the dropped one.
          if (cell.getBBox().containsPoint(g.point(x, y))) {
              return true;
          }
          return false;
      });
      
      // If the two elements are connected already, don't
      // connect them again (this is application specific though).
      if (elementBelow && !_.contains(graph.getNeighbors(elementBelow), cellView.model)) {
          
          graph.addCell(new joint.dia.Link({
              source: { id: cellView.model.id }, target: { id: elementBelow.id },
              attrs: { '.marker-source': { d: 'M 10 0 L 0 5 L 10 10 z' } }
          }));
          // Move the element a bit to the side.
          cellView.model.translate(-200, 0);
      }
  });*/
  
  function muestraNombre(){
	  var divPrincipal = document.getElementById("nameClass");
	  
	  var txtNombreClase = document.createElement('input');
	  txtNombreClase.type = 'text';
	  txtNombreClase.id = 'className';
	  txtNombreClase.value = nombre;
	  divPrincipal.appendChild(txtNombreClase);
	  
	  var btnNombre = document.createElement('button');
	  btnNombre.type = 'button';
	  btnNombre.id = 'btnClassName';
	  btnNombre.textContent = '>';
	  btnNombre.addEventListener('click', cambiaNombreClase);
	  divPrincipal.appendChild(btnNombre);
	  
  }
  
  //Cambia el nombre de la clase del elemento previamente seleccionado
  function cambiaNombreClase(){
	  var nombreNuevo = document.getElementById("className");
	  var nombre = nombreNuevo.value;
	  elementoActual.model.set({name: nombre});
  }
  
  //Crea los elementos necesarios para mostrar los atributos de una clase
  function muestraAttrs(){
	  
	  var divPrincipal = document.getElementById('attribs');
	  
	  for(var i=0; i<atributos.length; i++){
		  
		  var botonBorrar = document.createElement('button');
		  botonBorrar.type = 'button';
		  botonBorrar.textContent = '-';
		  botonBorrar.id = 'btnDelA_' + i;
		  if(i == 0){
			  botonBorrar.disabled = 'disabled';
		  }
		  botonBorrar.addEventListener('click', eliminaAtributo);
		  divPrincipal.appendChild(botonBorrar);
		  
		  var txtAtributo = document.createElement('input');
		  txtAtributo.type = 'text';
		  txtAtributo.value = atributos[i];
		  txtAtributo.id = 'txtAttr_' + i;
		  divPrincipal.appendChild(txtAtributo);
		  
		  var botonAgregar = document.createElement('button');
		  botonAgregar.type = 'button';
		  botonAgregar.textContent = '+';
		  botonAgregar.id = 'btnAddA_' + i;
		  botonAgregar.addEventListener('click', agregaAtributo);
		  divPrincipal.appendChild(botonAgregar);
		  
		  var br = document.createElement('br');
		  br.id = 'brA_' + i;
		  divPrincipal.appendChild(br);
		  
		  
	  }
	  
  }
  
  function agregaAtributo() {
		var idBoton = this.id.split("");
		var tam = idBoton.length;
		var numeroElementoActual = obtenNumero(idBoton, tam); //Aqui va lo que regresa la funcion
		var nameTxtAtributo = "txtAttr_";
		
		var at = [];
		for (var i = 0; i < atributos.length; i++) {
			var txtAtributo = document.getElementById(nameTxtAtributo + i);

			if (i == (numeroElementoActual - 1)) {
				at.push(txtAtributo.value);
			} else {
				at.push(atributos[i]);
			}

		}

		if (numeroElementoActual == atributos.length) {
			var divPrincipal = document.getElementById('attribs');

			var botonBorrar = document.createElement('button');
			botonBorrar.type = 'button';
			botonBorrar.textContent = '-';
			botonBorrar.id = 'btnDelA_' + atributos.length;
			botonBorrar.addEventListener('click', eliminaAtributo);
			divPrincipal.appendChild(botonBorrar);

			var txtAtributo2 = document.createElement('input');
			txtAtributo2.type = 'text';
			txtAtributo2.value = '';
			txtAtributo2.id = 'txtAttr_' + atributos.length;
			divPrincipal.appendChild(txtAtributo2);

			var botonAgregar = document.createElement('button');
			botonAgregar.type = 'button';
			botonAgregar.textContent = '+';
			botonAgregar.id = 'btnAddA_' + atributos.length;
			botonAgregar.addEventListener('click', agregaAtributo);
			divPrincipal.appendChild(botonAgregar);

			var br = document.createElement('br');
			br.id = 'brA_' + atributos.length;
			divPrincipal.appendChild(br);

			at.push(' ');
			var nvaAltura = parseInt(tamanio.height + 15);
			var ancho = tamanio.width;
			tamanio.height = nvaAltura;
			elementoActual.model.set({size: { width: ancho, height: nvaAltura }});
		}

		atributos = at;
		elementoActual.model.set({attributes : at});

	}
  
  function eliminaAtributo(){
	  var idBoton = this.id.split('');
	  var tam = idBoton.length;
	  var numeroElementoActual = obtenNumero(idBoton, tam);
	  var divPrincipal = document.getElementById('attribs');
	  
	  var at = [];
	  var botonDel = document.getElementById('btnDelA_' + (numeroElementoActual-1));
	  var txtAttr = document.getElementById('txtAttr_' + (numeroElementoActual-1));
	  var botonAdd = document.getElementById('btnAddA_' + (numeroElementoActual-1));
	  var br = document.getElementById('brA_' + (numeroElementoActual-1));
	  atributos.splice((numeroElementoActual-1), 1);
	  
	  divPrincipal.removeChild(botonDel);
	  divPrincipal.removeChild(txtAttr);
	  divPrincipal.removeChild(botonAdd);
	  divPrincipal.removeChild(br);
	  
	  var nvaAltura = parseInt(tamanio.height - 15);
	  var ancho = tamanio.width;
	  tamanio.height = nvaAltura;
	  elementoActual.model.set({size: { width: ancho, height: nvaAltura }});
	  
	  //Actualiza los id de los elementos HTML siguientes al eliminado
	  for(var i = 0; i<atributos.length; i++){
		  
		  if(i < (numeroElementoActual-1)){
			  at.push(atributos[i]);
		  }
		  else{
			  
			  var sigBotonDel = document.getElementById('btnDelA_' + (i+1));
			  sigBotonDel.id = 'btnDelA_' + i;
			  
			  var sigTxtAttr = document.getElementById('txtAttr_' + (i+1));
			  sigTxtAttr.id = 'txtAttr_' + i;
			  
			  var sigBotonAdd = document.getElementById('btnAddA_' + (i+1));
			  sigBotonAdd.id = 'btnAddA_' + i;
			  
			  var sigBr = document.getElementById('br_' + (i+1));
			  sigBr.id = 'brA_' + i;
			  
			  at.push(sigTxtAttr.value);
		  }
	  }
	  
	  elementoActual.model.set({attributes: at});
	  
  }
  
//Crea los elementos necesarios para mostrar los metodos de una clase
  function muestraMetodos(){
	  
	  var divPrincipal = document.getElementById('meths');
	  
	  for(var i=0; i<metodos.length; i++){
		  
		  var botonBorrar = document.createElement('button');
		  botonBorrar.type = 'button';
		  botonBorrar.textContent = '-';
		  botonBorrar.id = 'btnDelM_' + i;
		  if(i == 0){
			  botonBorrar.disabled = 'true';
		  }
		  botonBorrar.addEventListener('click', eliminaMetodo);
		  divPrincipal.appendChild(botonBorrar);
		  
		  var txtMetodo = document.createElement('input');
		  txtMetodo.type = 'text';
		  txtMetodo.value = metodos[i];
		  txtMetodo.id = 'txtMethod_' + i;
		  divPrincipal.appendChild(txtMetodo);
		  
		  var botonAgregar = document.createElement('button');
		  botonAgregar.type = 'button';
		  botonAgregar.textContent = '+';
		  botonAgregar.id = 'btnAddM_' + i;
		  botonAgregar.addEventListener('click', agregaMetodo);
		  divPrincipal.appendChild(botonAgregar);
		  
		  var br = document.createElement('br');
		  br.id = 'brM_' + i;
		  divPrincipal.appendChild(br);
		  
		  
	  }
	  
  }
  
  function agregaMetodo(){
	  	var idBoton = this.id.split("");
		var tam = idBoton.length;
		var numeroElementoActual = obtenNumero(idBoton, tam);
		var nameTxtMetodo = "txtMethod_";

		var met = [];
		for (var i = 0; i < metodos.length; i++) {
			var txtMetodo = document.getElementById(nameTxtMetodo + i);

			if (i == (numeroElementoActual - 1)) {
				met.push(txtMetodo.value);
			} else {
				met.push(metodos[i]);
			}

		}

		if (numeroElementoActual == metodos.length) {
			var divPrincipal = document.getElementById('meths');

			var botonBorrar = document.createElement('button');
			botonBorrar.type = 'button';
			botonBorrar.textContent = '-';
			botonBorrar.id = 'btnDelM_' + metodos.length;
			botonBorrar.addEventListener('click', eliminaMetodo);
			divPrincipal.appendChild(botonBorrar);

			var txtMetodo2 = document.createElement('input');
			txtMetodo2.type = 'text';
			txtMetodo2.value = '';
			txtMetodo2.id = 'txtMethod_' + metodos.length;
			divPrincipal.appendChild(txtMetodo2);

			var botonAgregar = document.createElement('button');
			botonAgregar.type = 'button';
			botonAgregar.textContent = '+';
			botonAgregar.id = 'btnAddM_' + metodos.length;
			botonAgregar.addEventListener('click', agregaMetodo);
			divPrincipal.appendChild(botonAgregar);

			var br = document.createElement('br');
			br.id = 'brM_' + i;
			divPrincipal.appendChild(br);

			metodos.push(' ');
			met.push(' ');
			var nvaAltura = parseInt(tamanio.height + 15);
			var ancho = tamanio.width;
			tamanio.height = nvaAltura;
			elementoActual.model.set({size: { width: ancho, height: nvaAltura }});
		}

		metodos = met;
		elementoActual.model.set({methods: met});
		
  }
  
  function eliminaMetodo(){
	  
	  var idBoton = this.id.split('');
	  var tam = idBoton.length;
	  var numeroElementoActual = obtenNumero(idBoton, tam);
	  var divPrincipal = document.getElementById('meths');
	  
	  var met = [];
	  var botonDel = document.getElementById('btnDelM_' + (numeroElementoActual-1));
	  var txtMetodo = document.getElementById('txtMethod_' + (numeroElementoActual-1));
	  var botonAdd = document.getElementById('btnAddM_' + (numeroElementoActual-1));
	  var br = document.getElementById('brM_' + (numeroElementoActual-1));
	  metodos.splice((numeroElementoActual-1), 1);
	  
	  divPrincipal.removeChild(botonDel);
	  divPrincipal.removeChild(txtMetodo);
	  divPrincipal.removeChild(botonAdd);
	  divPrincipal.removeChild(br);
	  
	  var nvaAltura = parseInt(tamanio.height - 15);
	  var ancho = tamanio.width;
	  tamanio.height = nvaAltura;
	  elementoActual.model.set({size: { width: ancho, height: nvaAltura }});
	  
	  //Actualiza los id de los elementos HTML siguientes al eliminado
	  for(var i = 0; i<metodos.length; i++){
		  
		  if(i < (numeroElementoActual-1)){
			  met.push(metodos[i]);
		  }
		  else{
			  
			  var sigBotonDel = document.getElementById('btnDelM_' + (i+1));
			  sigBotonDel.id = 'btnDelM_' + i;
			  
			  var sigTxtAttr = document.getElementById('txtMethod_' + (i+1));
			  sigTxtAttr.id = 'txtMethod_' + i;
			  
			  var sigBotonAdd = document.getElementById('btnAddM_' + (i+1));
			  sigBotonAdd.id = 'btnAddM_' + i;
			  
			  var sigBr = document.getElementById('brM_' + (i+1));
			  sigBr.id = 'brM_' + i;
			  
			  met.push(sigTxtAttr.value);
		  }
	  }
	  
	  elementoActual.model.set({methods: met});
	  
  }
  
  function obtenNumero(idBoton, tam){
	  
	  var decimal = 1;
	  var num = 0;
	  
	  for(var i=(tam-1); i>7; i--){
		  num = num + (parseInt(idBoton[i]) * decimal);
		  decimal = decimal * 10;
	  }
	 
	  return num+1;
  }
  
  //Crea un nuevo enlace de Generalizacion y lo muestra en el centro de la grafica
  function creaLinkG(){
	  var newLink = [
		new uml.Generalization({ source: {x:400, y:200}, target: {x:400, y:300} })
	  ];
	  
	  _.each(newLink, function(z){ graph.addCell(z); });
  }
  
//Crea un nuevo enlace de Implementacion y lo muestra en el centro de la grafica
  function creaLinkI(){
	  var newLink = [
		new uml.Implementation({ source: {x:400, y:200}, target: {x:400, y:300} })
	  ];
	  
	  _.each(newLink, function(z){ graph.addCell(z); });
  }
  
//Crea un nuevo enlace de Agregacion y lo muestra en el centro de la grafica
  function creaLinkA(){
	  var newLink = [
		new uml.Aggregation({ source: {x:400, y:200}, target: {x:400, y:300} })
	  ];
	  
	  _.each(newLink, function(z){ graph.addCell(z); });
  }
  
//Crea un nuevo enlace de Composicion y lo muestra en el centro de la grafica
  function creaLinkC(){
	  var newLink = [
		new uml.Composition({ source: {x:400, y:200}, target: {x:400, y:300} })
	  ];
	  
	  _.each(newLink, function(z){ graph.addCell(z); });
  }
  
//Creacion de una nueva clase en el diagrama
  function creaClase(){
  var newClass = {
		  nuevaClase: new uml.Class({
		      position: { x:300  , y: 300 },
		      size: { width: 180, height: 70 },
		      name: 'NewClass',
		      attributes: ['No-Attributes'],
	          methods: ['No-Methods'],
	          attrs: {
	              '.uml-class-name-rect': {
	                  fill: '#ff8450',
	                  stroke: '#fff',
	                  'stroke-width': 0.5,
	              },
	              '.uml-class-attrs-rect, .uml-class-methods-rect': {
	                  fill: '#fe976a',
	                  stroke: '#fff',
	                  'stroke-width': 0.5
	              },
	              '.uml-class-attrs-text': {
	            	  'ref-y': 0.5,
	                  'ref-x': 0.5,
	                  'y-alignment': 'middle',
	                  'x-alignment': 'middle'
	              },
	              '.uml-class-methods-text': {
	            	  'ref-y': 0.5,
	                  'ref-x': 0.5,
	                  'y-alignment': 'middle',
	                  'x-alignment': 'middle'
	              }
	          }
		  })
  };
  
  _.each(newClass, function(nc){ graph.addCell(nc); });
  
}
  //Creacion de una clase abstracta en el diagrama
  function creaClaseAbs(){
  var newAbstractClass = {
	  nuevaClaseAbstracta: new uml.Abstract({
		  
		  position: { x:300  , y: 300 },
	      size: { width: 180, height: 70 },
	      name: 'NewAbstractClass',
	      attributes: ['No-Attributes'],
          methods: ['No-Methods'],
          attrs: {
              '.uml-class-name-rect': {
                  fill: '#68ddd5',
                  stroke: '#ffffff',
                  'stroke-width': 0.5
              },
              '.uml-class-attrs-rect, .uml-class-methods-rect': {
                  fill: '#9687fe',
                  stroke: '#fff',
                  'stroke-width': 0.5
              },
              '.uml-class-attrs-text': {
            	  'ref-y': 0.5,
                  'ref-x': 0.5,
                  'y-alignment': 'middle',
                  'x-alignment': 'middle',
                  fill: '#fff'
              },
              '.uml-class-methods-text': {
            	  'ref-y': 0.5,
                  'ref-x': 0.5,
                  'y-alignment': 'middle',
                  'x-alignment': 'middle',
                  fill: '#fff'
              }
          }
		  
	  })
  };
  
  _.each(newAbstractClass, function(nac){ graph.addCell(nac); });
}
  
  //Creacion de una interface en el diagrama
  function creaInterfaz(){
  var newInterface = {
	  
	  nuevaInterfaz: new uml.Interface({
		  
		  position: { x:300  , y: 300 },
	      size: { width: 180, height: 70 },
	      name: 'NewInterface',
	      attributes: ['No-Attributes'],
          methods: ['No-Methods'],
          attrs: {
              '.uml-class-name-rect': {
                  fill: '#feb662',
                  stroke: '#ffffff',
                  'stroke-width': 0.5
              },
              '.uml-class-attrs-rect, .uml-class-methods-rect': {
                  fill: '#fdc886',
                  stroke: '#fff',
                  'stroke-width': 0.5
              },
              '.uml-class-attrs-text': {
                  ref: '.uml-class-attrs-rect',
                  'ref-y': 0.5,
                  'ref-x': 0.5,
                  'y-alignment': 'middle',
                  'x-alignment': 'middle'
              },
              '.uml-class-methods-text': {
                  ref: '.uml-class-methods-rect',
                  'ref-y': 0.5,
                  'ref-x': 0.5,
                  'y-alignment': 'middle',
                  'x-alignment': 'middle'
              }

          }
		  
	  })
	  
  };
  
  _.each(newInterface, function(ni){ graph.addCell(ni); });
}