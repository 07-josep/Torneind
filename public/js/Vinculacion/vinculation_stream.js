//Array con las plataformas
const arrayDirectos = [{
    id: 'YT',
    nombrePlataforma: 'Youtube',
    descripcion: 'Iniciar directo mediante Youtube',
    foto: 'https://www.unpocogeek.com/wp-content/uploads/2017/04/youtube_nuevas_reglas_unpocogeek.com_.jpg',
    pagina: 'https://studio.youtube.com/channel/UCkEDizJjz1V7BKxVvNOOZxg/livestreaming'
}, {
    id: 'TW',
    nombrePlataforma: 'Twitch',
    descripcion: 'Iniciar directo mediante Twitch',
    foto: 'https://imborrable.com/wp-content/uploads/2021/01/twitch-logo-2019.png',
    pagina: 'https://www.twitch.tv/'

}, {
    id: 'FB',
    nombrePlataforma: 'Facebook Gaming',
    descripcion: 'Iniciar directo mediante Facebook Gaming',
    foto: 'https://www.zonammorpg.com/wp-content/uploads/2018/06/facebook-gaming-2.png',
    pagina: 'https://www.facebook.com/login/?next=%2Ffbgaminghome%2Fcreators%2Fgetstarted%3Flocale%3Des_LA'
}]

//Crear cartilla plataformas.

function createplataforma(plataforma) {
    const plataformaHTML = `
    <div class="plataforma" id="${plataforma.id}">
      <div class="plataforma-container">
        <div class="foto-image" style="background-image: url('${plataforma.foto}');"></div>
        <div class="content">
          <h1 class="nombrePlataforma">${plataforma.nombrePlataforma}</h1>
          <h6 class="descripcion">${plataforma.descripcion}</h6>
        </div>
      </div>
      <a href="${plataforma.pagina}" target="_blank" class="pagina ${plataforma.id}"><i class="fal fa-arrow-alt-to-right"></i></a>
    </div>
   `;
    return plataformaHTML;
}

for (const plataforma of arrayDirectos) {
    $('.plataformas').append(createplataforma(plataforma));
}

const $init = 'fondo';
$('html').addClass($init);
$('.plataforma#' + $init).addClass('active');
$('.plataforma#' + $init).find('.pagina').addClass('active');
$('.heading').append('¡ Inicia un directo !')

// plataforma card click action
$('.plataforma').click(function() {
    $('html').removeClass();
    $('html').addClass($(this).attr('id'));

    $('.heading').empty();
    $('.heading').append($(this).find('.nombrePlataforma').text());

    //   set class active and remove from sibs
    $(this).siblings('.plataforma').removeClass('active');
    $(this).siblings('.plataforma').find('.pagina').removeClass('active');
    $(this).addClass('active');
    $(this).find('.pagina').addClass('active');
});

// hover animation
$('.plataforma').hover(function() {
    $(this).addClass('hover');
}, function() {
    $(this).removeClass('hover');
});