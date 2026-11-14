
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>La Loto Estadística</title>


    <style>
        * { box-sizing: border-box; }
        :root {
            --azul: #1d4ed8;
            --azul-oscuro: #12306b;
            --texto: #172033;
            --muted: #64748b;
            --borde: #dce5f1;
            --fondo: #f3f7fc;
            --blanco: #ffffff;
            --amarillo: #fbbf24;
        }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            color: var(--texto);
            background:
                radial-gradient(circle at 12% 8%, rgba(59,130,246,.12), transparent 28rem),
                linear-gradient(180deg, #f8fbff 0%, #eef4fb 100%);
        }
        .contenedor {
            width: min(1080px, 94%);
            margin: auto;
            padding: 42px 0 56px;
        }
        .hero {
            position: relative;
            overflow: hidden;
            padding: 34px 28px 38px;
            margin-bottom: 28px;
            text-align: center;
            color: white;
            border-radius: 26px;
            background: linear-gradient(125deg, #102b59 0%, #1d4ed8 62%, #3b82f6 100%);
            box-shadow: 0 18px 45px rgba(30,64,175,.18);
        }
        .hero::before, .hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.07);
            pointer-events: none;
        }
        .hero::before { width: 260px; height: 260px; top: -150px; right: -55px; }
        .hero::after { width: 190px; height: 190px; bottom: -135px; left: -45px; }
        .marca, .subtitulo { position: relative; z-index: 1; }
        .marca {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        .logo-icono {
            display: grid;
            place-items: center;
            width: 58px;
            height: 58px;
            font-size: 31px;
            border-radius: 18px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.22);
        }
        h1 {
            margin: 0;
            font-size: clamp(29px, 5vw, 46px);
            letter-spacing: -.8px;
            font-weight: 800;
        }
        .subtitulo {
            margin: 13px 0 0;
            color: #dbeafe;
            font-size: 15px;
        }
        .panel {
            position: relative;
            padding: 34px 24px 26px;
            text-align: center;
            background: var(--blanco);
            border: 1px solid var(--borde);
            border-radius: 24px;
            box-shadow: 0 12px 32px rgba(15, 41, 77, .07);
        }
        .panel-cabecera { margin-bottom: 22px; }
        .panel h2 {
            margin: 0 0 8px;
            color: #172b4d;
            font-size: 24px;
        }
        .panel-descripcion {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }
        .digitos {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin: 26px 0 24px;
        }
        .digito {
            width: 174px;
            max-width: 44%;
            min-height: 190px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px 12px 17px;
            color: #10234a;
            background: linear-gradient(180deg, #fff 0%, #f4f8ff 100%);
            border: 1px solid #d9e5f5;
            border-radius: 22px;
            box-shadow: 0 9px 24px rgba(30,64,175,.09), inset 0 1px 0 #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .digito:hover { transform: translateY(-3px); box-shadow: 0 14px 28px rgba(30,64,175,.13); }
        .numero {
            font-size: clamp(76px, 12vw, 104px);
            font-weight: 850;
            line-height: 1;
            font-variant-numeric: tabular-nums;
            letter-spacing: -4px;
            color: #142b55;
        }
        .etiqueta {
            margin-top: 15px;
            font-size: 11px;
            letter-spacing: 1.1px;
            font-weight: 800;
            color: #64748b;
        }
        .girando {
            animation: pulso .12s infinite alternate;
            color: var(--azul);
            text-shadow: 0 5px 20px rgba(37,99,235,.16);
        }
        @keyframes pulso {
            from { transform: translateY(-3px) scale(.99); }
            to { transform: translateY(3px) scale(1.01); }
        }
        .boton {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-width: 220px;
            padding: 17px 30px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #172033;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .3px;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(245,158,11,.23);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }
        .boton:hover {
            transform: translateY(-2px);
            filter: brightness(1.03);
            box-shadow: 0 12px 22px rgba(245,158,11,.3);
        }
        .boton:active { transform: translateY(0); }
        .boton:disabled { opacity: .65; cursor: wait; transform: none; }
        #mensaje {
            min-height: 24px;
            margin: 17px 0 0;
            color: #52647f;
            font-size: 14px;
            font-weight: 600;
        }
        .mensaje-resultado { color: #15803d !important; }
        .historial {
            margin-top: 30px;
            padding: 26px;
            text-align: left;
            background: var(--blanco);
            border: 1px solid var(--borde);
            border-radius: 22px;
            box-shadow: 0 10px 28px rgba(15,41,77,.055);
        }
        .historial-cabecera {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 15px;
            margin-bottom: 18px;
        }
        .historial h2 {
            margin: 0;
            color: #172b4d;
            font-size: 21px;
        }
        .historial-cabecera p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 13px;
        }
        .contador {
            padding: 7px 12px;
            color: #1d4ed8;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }
        .tabla-contenedor { overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 14px; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #edf1f7;
        }
        th {
            color: #425675;
            background: #f4f7fc;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .65px;
        }
        td { color: #475569; font-size: 14px; }
        tbody tr { transition: background .15s ease; }
        tbody tr:nth-child(even) { background: #fbfdff; }
        tbody tr:hover { background: #eff6ff; }
        .numero-historial {
            color: #1d4ed8;
            font-size: 22px;
            font-weight: 850;
            letter-spacing: 1px;
            font-variant-numeric: tabular-nums;
        }
        .pie {
            padding: 22px 10px 0;
            text-align: center;
            color: #8290a5;
            font-size: 12px;
        }

        .control-sonido { margin-top: 13px; }
        .boton-sonido {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 7px 11px; border: 1px solid #dbe5f1;
            border-radius: 999px; color: #52647f; background: #f8fafc;
            font-size: 12px; font-weight: 650; cursor: pointer;
            transition: background .18s ease, border-color .18s ease;
        }
        .boton-sonido:hover { background: #eff6ff; border-color: #bfdbfe; }
        .boton-sonido:focus-visible { outline: 3px solid rgba(59,130,246,.25); outline-offset: 2px; }

        @media (max-width: 600px) {
            .contenedor { width: min(100% - 24px, 520px); padding: 18px 0 32px; }
            .hero { padding: 27px 15px 30px; border-radius: 20px; }
            .marca { gap: 10px; }
            .logo-icono { width: 46px; height: 46px; font-size: 25px; border-radius: 14px; }
            h1 { font-size: clamp(23px, 7vw, 32px); }
            .subtitulo { font-size: 13px; }
            .panel { padding: 27px 12px 22px; border-radius: 20px; }
            .panel h2 { font-size: 21px; }
            .digitos { gap: 11px; }
            .digito { min-height: 155px; padding: 17px 6px 14px; border-radius: 17px; }
            .numero { font-size: clamp(65px, 18vw, 84px); }
            .etiqueta { font-size: 9px; letter-spacing: .5px; }
            .boton { width: min(100%, 300px); }
            .historial { padding: 19px 12px; border-radius: 18px; }
            .historial-cabecera { align-items: start; flex-direction: column; }
            th, td { padding: 12px 9px; font-size: 12px; }
            .numero-historial { font-size: 20px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
.acciones-sorteo {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    margin-top: 22px;
}

.acciones-sorteo .boton,
.acciones-sorteo .btn-estadisticas {
    width: 240px;
    min-height: 54px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-sizing: border-box;
    border-radius: 14px;
    font-family: inherit;
    font-size: 15px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.25s ease;
}

.acciones-sorteo .btn-estadisticas {
    color: #ffffff;
    background: linear-gradient(135deg, #173d83, #2874ed);
    border: none;
    box-shadow: 0 5px 14px rgba(23, 61, 131, 0.20);
}

.acciones-sorteo .btn-estadisticas:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(23, 61, 131, 0.30);
    color: #ffffff;
}

    </style>

</head>
<body>
    <main class="contenedor">
        <header class="hero">
            <div class="marca">
                <span class="logo-icono" aria-hidden="true">🎯</span>
                <h1>LA LOTO ESTADÍSTICA</h1>
            </div>
            <p class="subtitulo">Un experimento aleatorio para aprender estadística</p>
        </header>

        <section class="panel">
            <div class="panel-cabecera">
                <h2 id="tituloSorteo">¡Prepárate para el sorteo!</h2>
                <p class="panel-descripcion">Dos cifras · Un resultado aleatorio · Una experiencia estadística</p>
            </div>

            <div class="digitos">
                <div class="digito">
                    <div id="primeraCifra" class="numero">0</div>
                    <div class="etiqueta">PRIMERA CIFRA</div>
                </div>

                <div class="digito">
                    <div id="segundaCifra" class="numero">0</div>
                    <div class="etiqueta">SEGUNDA CIFRA</div>
                </div>
            </div>

          <div class="acciones-sorteo">

    <button id="btnSorteo" class="boton" onclick="iniciarSorteo()">
        <span aria-hidden="true">▶</span> INICIAR SORTEO
    </button>

    <a href="{{ url('/estadisticas') }}" class="btn-estadisticas">
        <span aria-hidden="true">📊</span> VER ESTADÍSTICAS
    </a>

    <a href="{{ route('pronostico.index') }}" class="boton">
    Pronósticos
</a>
</div>

<div class="control-sonido">
    <button type="button" id="btnSonido" class="boton-sonido"
            aria-pressed="true" title="Silenciar efectos de sonido">
        <span id="iconoSonido" aria-hidden="true">🔊</span>
        <span id="textoSonido">Sonido activado</span>
    </button>
</div>

            <p id="mensaje" role="status" aria-live="polite">
                Pulsa el botón para comenzar.
            </p>
        </section>

        <section class="historial">
            <div class="historial-cabecera">
                <div>
                    <h2>Historial de sorteos</h2>
                    <p>Consulta los resultados registrados anteriormente.</p>
                </div>
                <span class="contador">Registro de resultados</span>
            </div>

            <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>N.º</th>
                        <th>Resultado</th>
                        <th>Fecha y hora</th>
                    </tr>
                </thead>
                <tbody id="tablaHistorial">
                    <tr>
                        <td colspan="3">Cargando historial...</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </section>

        <footer class="pie">La Loto Estadística · Experimento aleatorio con fines educativos</footer>
    </main>

    <script>
        const primera = document.getElementById('primeraCifra');
        const segunda = document.getElementById('segundaCifra');
        const boton = document.getElementById('btnSorteo');
        const mensaje = document.getElementById('mensaje');
        const titulo = document.getElementById('tituloSorteo');
        const tabla = document.getElementById('tablaHistorial');

        let ocupado = false;


        // Redoble sintetizado con Web Audio API: no requiere descargar archivos.
        let sonidoActivado = true;
        let contextoAudio = null;
        let temporizadorRedoble = null;

        const botonSonido = document.getElementById('btnSonido');
        const iconoSonido = document.getElementById('iconoSonido');
        const textoSonido = document.getElementById('textoSonido');

        botonSonido.addEventListener('click', () => {
            sonidoActivado = !sonidoActivado;
            botonSonido.setAttribute('aria-pressed', String(sonidoActivado));
            iconoSonido.textContent = sonidoActivado ? '🔊' : '🔇';
            textoSonido.textContent = sonidoActivado ? 'Sonido activado' : 'Sonido silenciado';
            botonSonido.title = sonidoActivado ? 'Silenciar efectos de sonido' : 'Activar efectos de sonido';
            if (!sonidoActivado) detenerRedoble(false);
        });

        async function prepararAudio() {
            const AudioContextClass = window.AudioContext || window.webkitAudioContext;
            if (!AudioContextClass || !sonidoActivado) return false;
            try {
                if (!contextoAudio) contextoAudio = new AudioContextClass();
                if (contextoAudio.state === 'suspended') await contextoAudio.resume();
                return true;
            } catch (error) {
                console.warn('El audio no está disponible en este navegador.', error);
                return false;
            }
        }

        function golpeTambor(intensidad = 1, frecuencia = 105) {
            if (!contextoAudio || !sonidoActivado) return;
            const ahora = contextoAudio.currentTime;
            const duracion = 0.105;
            const buffer = contextoAudio.createBuffer(1, Math.floor(contextoAudio.sampleRate * duracion), contextoAudio.sampleRate);
            const datos = buffer.getChannelData(0);
            for (let i = 0; i < datos.length; i++) {
                datos[i] = (Math.random() * 2 - 1) * Math.pow(1 - i / datos.length, 3);
            }

            const ruido = contextoAudio.createBufferSource();
            ruido.buffer = buffer;
            const filtro = contextoAudio.createBiquadFilter();
            filtro.type = 'lowpass';
            filtro.frequency.setValueAtTime(frecuencia * 7, ahora);
            filtro.frequency.exponentialRampToValueAtTime(frecuencia * 1.8, ahora + duracion);
            const volumen = contextoAudio.createGain();
            volumen.gain.setValueAtTime(0.0001, ahora);
            volumen.gain.exponentialRampToValueAtTime(0.18 * intensidad, ahora + 0.008);
            volumen.gain.exponentialRampToValueAtTime(0.0001, ahora + duracion);

            const tono = contextoAudio.createOscillator();
            const tonoVolumen = contextoAudio.createGain();
            tono.type = 'sine';
            tono.frequency.setValueAtTime(frecuencia, ahora);
            tono.frequency.exponentialRampToValueAtTime(frecuencia * 0.48, ahora + 0.09);
            tonoVolumen.gain.setValueAtTime(0.12 * intensidad, ahora);
            tonoVolumen.gain.exponentialRampToValueAtTime(0.0001, ahora + 0.11);

            ruido.connect(filtro); filtro.connect(volumen); volumen.connect(contextoAudio.destination);
            tono.connect(tonoVolumen); tonoVolumen.connect(contextoAudio.destination);
            ruido.start(ahora); ruido.stop(ahora + duracion);
            tono.start(ahora); tono.stop(ahora + 0.12);
        }

        async function iniciarRedoble() {
            detenerRedoble(false);
            if (!(await prepararAudio())) return;
            let paso = 0;
            const marcar = () => {
                if (!sonidoActivado || !contextoAudio) return;
                const intervalo = Math.max(75, 190 - paso * 3.2);
                const intensidad = Math.min(1.25, 0.55 + paso * 0.018);
                golpeTambor(intensidad, 105 + Math.min(35, paso));
                paso++;
                temporizadorRedoble = setTimeout(marcar, intervalo);
            };
            marcar();
        }

        function detenerRedoble(conGolpeFinal = true) {
            if (temporizadorRedoble) {
                clearTimeout(temporizadorRedoble);
                temporizadorRedoble = null;
            }
            if (conGolpeFinal && sonidoActivado && contextoAudio) golpeTambor(1.45, 75);
        }


        function esperar(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function girarDigito(elemento, resultado, duracion) {
            elemento.classList.add('girando');

            const inicio = Date.now();

            while (Date.now() - inicio < duracion) {
                elemento.textContent = Math.floor(Math.random() * 10);
                await esperar(70);
            }

            elemento.textContent = resultado;
            elemento.classList.remove('girando');
        }

        async function iniciarSorteo() {
            if (ocupado) return;

            ocupado = true;
            boton.disabled = true;
            primera.textContent = '0';
            segunda.textContent = '0';
            titulo.textContent = '¡Sorteo en curso!';
            mensaje.textContent = 'Girando la primera cifra...';
            mensaje.classList.remove('mensaje-resultado');
            iniciarRedoble();

            try {
                // El servidor genera y guarda el resultado definitivo.
                const respuesta = await fetch(
                    @json(url('/sorteo/generar')),
                    {
                        headers: { 'Accept': 'application/json' }
                    }
                );

                if (!respuesta.ok) {
                    throw new Error('No se pudo generar el sorteo.');
                }

                const sorteo = await respuesta.json();
                const numero = String(sorteo.numero).padStart(2, '0');

                // Primera cifra: gira y se detiene.
                await girarDigito(primera, numero[0], 3000);

                mensaje.textContent =
                    'Primera cifra detenida. Girando la segunda...';

                await esperar(500);

                // Segunda cifra: empieza después de detenerse la primera.
                await girarDigito(segunda, numero[1], 3000);

                titulo.textContent = '¡Resultado del sorteo!';
                mensaje.textContent =
                    'El número de esta ronda es: ' + numero;
                mensaje.classList.add('mensaje-resultado');
                detenerRedoble(true);

                await cargarHistorial();
            } catch (error) {
                mensaje.textContent =
                    'Ocurrió un error al realizar el sorteo. Inténtalo nuevamente.';
                console.error(error);
            } finally {
                detenerRedoble(false);
                boton.disabled = false;
                ocupado = false;
            }
        }

        async function cargarHistorial() {
            try {
                const respuesta = await fetch(
                    @json(url('/sorteos/historial')),
                    {
                        headers: { 'Accept': 'application/json' }
                    }
                );

                if (!respuesta.ok) {
                    throw new Error('No se pudo cargar el historial.');
                }

                const sorteos = await respuesta.json();
                tabla.replaceChildren();

                if (sorteos.length === 0) {
                    const fila = tabla.insertRow();
                    const celda = fila.insertCell();
                    celda.colSpan = 3;
                    celda.textContent = 'Todavía no hay sorteos registrados.';
                    return;
                }

                sorteos.forEach(sorteo => {
                    const fila = tabla.insertRow();

                    const id = fila.insertCell();
                    id.textContent = sorteo.id;

                    const resultado = fila.insertCell();
                    resultado.textContent =
                        String(sorteo.numero).padStart(2, '0');
                    resultado.className = 'numero-historial';

                    const fecha = fila.insertCell();
                    fecha.textContent = new Date(
                        sorteo.created_at
                    ).toLocaleString('es-NI');
                });
            } catch (error) {
                tabla.replaceChildren();
                const fila = tabla.insertRow();
                const celda = fila.insertCell();
                celda.colSpan = 3;
                celda.textContent = 'No se pudo cargar el historial.';
                console.error(error);
            }
        }

        cargarHistorial();
    </script>
</body>
</html>
