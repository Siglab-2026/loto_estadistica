<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pronóstico Estadístico | La Loto Estadística</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #1e293b;
        }

        .contenedor {
            max-width: 1050px;
            margin: 35px auto;
            padding: 20px;
        }

        .encabezado {
            text-align: center;
            margin-bottom: 30px;
        }

        .encabezado h1 {
            color: #173d83;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .encabezado p {
            color: #64748b;
            margin: 0;
        }

        .resumen {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .tarjeta {
            background: white;
            border-radius: 16px;
            padding: 22px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
        }

        .tarjeta strong {
            display: block;
            font-size: 32px;
            color: #173d83;
            margin-bottom: 5px;
        }

        .tarjeta span {
            color: #64748b;
            font-size: 14px;
        }

        .panel {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
            margin-bottom: 22px;
        }

        .panel h2 {
            text-align: center;
            color: #173d83;
            margin-top: 0;
        }

        .candidatos {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .candidato {
            text-align: center;
            background: #f1f5f9;
            border-radius: 15px;
            padding: 18px 8px;
        }

        .numero {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: linear-gradient(135deg, #173d83, #2874ed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: bold;
            margin: 0 auto 12px;
        }

        .posicion {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 7px;
        }

        .puntuacion {
            font-weight: bold;
            color: #173d83;
            font-size: 14px;
        }

        .explicacion {
            background: #f8fafc;
            border-left: 4px solid #2874ed;
            padding: 15px;
            border-radius: 8px;
            margin-top: 22px;
            color: #475569;
            line-height: 1.6;
            font-size: 14px;
        }

        .boton {
            display: block;
            margin: 25px auto 0;
            padding: 17px 30px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #173d83, #2874ed);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .boton:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(23,61,131,.25);
        }

        .boton:disabled {
            opacity: .6;
            cursor: wait;
            transform: none;
        }

        .mensaje {
            text-align: center;
            margin-top: 15px;
            color: #475569;
            font-size: 14px;
        }

        .aviso {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 20px;
        }

        .volver {
            display: inline-block;
            margin-top: 25px;
            color: #173d83;
            text-decoration: none;
            font-weight: bold;
        }

        .volver:hover {
            text-decoration: underline;
        }

        @media (max-width: 650px) {
            .candidatos {
                grid-template-columns: repeat(2, 1fr);
            }

            .candidato:last-child {
                grid-column: 1 / -1;
            }

            .encabezado h1 {
                font-size: 25px;
            }

            .panel {
                padding: 20px 14px;
            }
        }
    
    
.detalle-candidato {
    margin-top: 12px;
    padding-top: 10px;
    border-top: 1px solid #dbe3ef;
    text-align: left;
    font-size: 12px;
    line-height: 1.7;
    color: #475569;
}

.detalle-candidato strong {
    color: #173d83;
}

.candidato {
    min-width: 0;
}


.tabla-historial {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}

.tabla-historial th,
.tabla-historial td {
    padding: 14px 12px;
    border-bottom: 1px solid #e2e8f0;
    text-align: center;
}

.tabla-historial th {
    background: #173d83;
    color: white;
}

.tabla-historial tbody tr:hover {
    background: #f8fafc;
}

.numeros-historial {
    color: #173d83;
    font-weight: bold;
    white-space: nowrap;
}

.estado-pendiente {
    color: #b7791f;
    font-weight: bold;
}


.estado-acierto {
    color: #15803d;
    font-weight: bold;
}

.estado-sin-acierto {
    color: #dc2626;
    font-weight: bold;
}

.numero-acertado {
    display: inline-block;
    background: #15803d;
    color: white;
    padding: 4px 8px;
    border-radius: 6px;
}


    </style>
</head>

<body>

<div class="contenedor">

    <header class="encabezado">
        <h1>PRONÓSTICO ESTADÍSTICO</h1>
        <p>La Loto Estadística · Análisis de resultados históricos</p>
    </header>

    <section class="resumen">

        <div class="tarjeta">
            <strong id="totalSorteos">--</strong>
            <span>Sorteos analizados</span>
        </div>

        <div class="tarjeta">
            <strong id="totalRecientes">--</strong>
            <span>Sorteos recientes utilizados</span>
        </div>

    </section>

    <section class="panel">

        <h2>Los 5 números candidatos</h2>

        <div id="candidatos" class="candidatos">
            <p style="grid-column:1/-1;text-align:center;color:#64748b;">
                Presiona el botón para generar un pronóstico.
            </p>
        </div>

        <div id="explicacion" class="explicacion" style="display:none;">
        </div>

        <button id="btnPronostico" class="boton"
                onclick="generarPronostico()">
            GENERAR PRONÓSTICO
        </button>

        <div id="mensaje" class="mensaje"></div>

    </section>

    <section class="panel">

        <h2>¿Cómo funciona el pronóstico?</h2>

        <div class="explicacion">
            <strong>50 % - Frecuencia histórica:</strong>
            analiza cuántas veces apareció cada número en el historial completo.
            <br><br>

            <strong>30 % - Frecuencia reciente:</strong>
            analiza los últimos 50 sorteos.
            <br><br>

            <strong>20 % - Comportamiento de dígitos:</strong>
            analiza la frecuencia de las decenas y unidades.
        </div>

        <p class="aviso">
            Este análisis identifica comportamientos observados en los
            resultados anteriores. No garantiza resultados futuros.
            En un sorteo aleatorio, todos los números mantienen la misma
            probabilidad teórica.
        </p>

    </section>


<section class="panel">
    <h2>Historial de pronósticos</h2>

    <p style="text-align:center;color:#64748b;">
        Consulta los números sugeridos en análisis anteriores.
    </p>

    <div style="overflow-x:auto;">
        <table class="tabla-historial">
            <thead>
                <tr>
                    <th>Pronóstico</th>
<th>Fecha</th>
<th>Números candidatos</th>
<th>Resultado real</th>
<th>Estado</th>
                </tr>
            </thead>

            <tbody id="tablaHistorial">
                <tr>
                    <td colspan="5" style="text-align:center;">
                        Cargando historial...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>


    <div style="text-align:center;">
        <a href="/" class="volver">← Volver al sorteo principal</a>
    </div>

</div>


<script>
    async function generarPronostico() {

        const boton = document.getElementById('btnPronostico');
        const mensaje = document.getElementById('mensaje');
        const candidatos = document.getElementById('candidatos');
        const explicacion = document.getElementById('explicacion');

        boton.disabled = true;
        boton.textContent = 'ANALIZANDO...';
        mensaje.textContent = 'Estamos analizando los resultados históricos...';

        try {
            const respuesta = await fetch(
                "{{ route('pronostico.generar') }}"
            );

            const datos = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(datos.mensaje || 'No se pudo generar el pronóstico.');
            }

            document.getElementById('totalSorteos').textContent =
                datos.total_sorteos_analizados;

            document.getElementById('totalRecientes').textContent =
                datos.sorteos_recientes_analizados;

            candidatos.innerHTML = '';

            datos.candidatos.forEach((candidato, indice) => {

                candidatos.innerHTML += `
                    <div class="candidato">

                        <div class="numero">${candidato.numero}</div>

                        <div class="posicion">
                            Candidato ${indice + 1}
                        </div>

                        <div class="puntuacion">
                            ${Number(candidato.puntuacion).toFixed(2)} puntos
                        </div>

                        <div class="detalle-candidato">
                            <strong>¿Qué encontramos?</strong><br>

                            Historial:
                            ${candidato.apariciones_historicas} apariciones<br>

                            Últimos 50:
                            ${candidato.apariciones_recientes} apariciones<br>

                            Decena:
                            ${candidato.frecuencia_decena} apariciones<br>

                            Unidad:
                            ${candidato.frecuencia_unidad} apariciones
                        </div>

                    </div>
                `;
            });

            explicacion.style.display = 'block';

            explicacion.innerHTML = `
                <strong>¿Por qué fueron seleccionados?</strong><br><br>
                El sistema evaluó los 100 números posibles considerando
                su frecuencia histórica, su comportamiento reciente
                y la frecuencia de sus decenas y unidades.
                <br><br>
                <strong>Pronóstico registrado:</strong> #${datos.pronostico_id}
            `;

            mensaje.textContent =
                'Pronóstico generado y guardado correctamente.';

        } catch (error) {

            console.error(error);
            mensaje.textContent = error.message;

        } finally {

            boton.disabled = false;
            boton.textContent = 'GENERAR NUEVO PRONÓSTICO';
        }
    }

async function cargarHistorial() {

    const tabla = document.getElementById('tablaHistorial');

    try {

        const respuesta = await fetch(
            "{{ route('pronostico.historial') }}"
        );

        const datos = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error('No se pudo cargar el historial.');
        }

        tabla.innerHTML = '';

        if (datos.pronosticos.length === 0) {
            tabla.innerHTML = `
                <tr>
                    <td colspan="5">Todavía no hay pronósticos registrados.</td>
                </tr>
            `;
            return;
        }

        
datos.pronosticos.forEach(pronostico => {

    const fecha = new Date(pronostico.fecha_generacion)
        .toLocaleString('es-NI');

    const numeros = pronostico.candidatos
        .map(c => {
            const clase = c.coincidio ? 'numero-acertado' : '';
            return `<span class="${clase}">${c.numero}</span>`;
        })
        .join(' - ');

    let claseEstado = '';
    
    if (pronostico.estado === 'Pendiente') {
        claseEstado = 'estado-pendiente';
    } else if (pronostico.estado === 'Con acierto') {
        claseEstado = 'estado-acierto';
    } else {
        claseEstado = 'estado-sin-acierto';
    }

    const resultado = pronostico.resultado_real ?? '—';

    tabla.innerHTML += `
        <tr>
            <td>#${pronostico.id}</td>
            <td>${fecha}</td>
            <td class="numeros-historial">${numeros}</td>
            <td><strong>${resultado}</strong></td>
            <td class="${claseEstado}">${pronostico.estado}</td>
        </tr>
    `;

});


    } catch (error) {

        console.error(error);

        tabla.innerHTML = `
            <tr>
                <td colspan="5">Error al consultar el historial.</td>
            </tr>
        `;
    }
}

document.addEventListener('DOMContentLoaded', cargarHistorial);


</script>


</body>
</html>
