const arrayCuentas = [{
    id: 'Epic',
    title: 'Epic Games',
    publisher: 'Vincular cuenta de Epic Games',
    cover: 'https://s1.eestatic.com/2020/08/14/elandroidelibre/el_androide_libre_512961490_179484698_1706x960.jpg',
    download: 'http://www.epicgames.com/fortnite/register?state=/success&isFromCTA=true'
}, {
    id: 'Sony',
    title: 'Play Station',
    publisher: 'Vincular cuenta de Play Station',
    cover: 'https://esports.as.com/2020/01/08/bonus/evolucion-logo-PlayStation_1316878307_320649_1440x810.png',
    download: 'https://my.account.sony.com/central/signin/?duid=0000000700090100a1c647f876b109a5091ce6d324bfb198b6d86b9c9a7b443f86f78dfe554e2637&response_type=code&client_id=e4a62faf-4b87-4fea-8565-caaabb3ac918&scope=web%3Acore&access_type=offline&state=02e67a96c099b583fd485900aa72450d535ebf7aff8db47bdc9a24f2e0db10ca&service_entity=urn%3Aservice-entity%3Apsn&ui=pr&smcid=web%3Apdc&redirect_uri=https%3A%2F%2Fweb.np.playstation.com%2Fapi%2Fsession%2Fv1%2Fsession%3Fredirect_uri%3Dhttps%253A%252F%252Fio.playstation.com%252Fcentral%252Fauth%252Flogin%253Flocale%253Des_ES%2526postSignInURL%253Dhttps%25253A%25252F%25252Fwww.playstation.com%25252Fes-es%25252F%25253Femcid%25253Dpa-co-422219%252526gclid%25253DCj0KCQjw06OTBhC_ARIsAAU1yOUOT18lfsTFEmYvnpDqdArmvgKPufRR86YjS_HXPXd86BqnLRGlPlQaAqZlEALw_wcB%252526gclsrc%25253Daw.ds%2526cancelURL%253Dhttps%25253A%25252F%25252Fwww.playstation.com%25252Fes-es%25252F%25253Femcid%25253Dpa-co-422219%252526gclid%25253DCj0KCQjw06OTBhC_ARIsAAU1yOUOT18lfsTFEmYvnpDqdArmvgKPufRR86YjS_HXPXd86BqnLRGlPlQaAqZlEALw_wcB%252526gclsrc%25253Daw.ds%26x-psn-app-ver%3D%2540sie-ppr-web-session%252Fsession%252Fv5.18.1&auth_ver=v3&error=login_required&error_code=4165&error_description=User+is+not+authenticated&no_captcha=false&cid=a76e369d-a03e-4ed6-a811-557346955927#/signin/ca?entry=ca'
}, {
    id: 'Micro',
    title: 'Xbox',
    publisher: 'Vincular cuenta de Xbox',
    cover: 'https://www.playerone.vg/wp-content/uploads/2020/10/xbox-free-play-days-juegos-gratis2-1.png',
    download: 'https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&rver=7.3.6963.0&wp=MBI_SSL&wreply=https:%2f%2faccount.xbox.com%2fes-es%2faccountcreation%3freturnUrl%3dhttps%253a%252f%252fwww.xbox.com%252fes-ES%252flive%26ru%3dhttps%253a%252f%252fwww.xbox.com%252fes-ES%252flive%26rtc%3d1%26csrf%3d4Y34s6CHRPPaUiH0FbVYC-DTdmayWt8V7g-QgZ9o22nxkXOSlgjNXz43bZh6wfolilfi_KWKHA-p8FtG2H0GpNkYJEE1&lc=3082&id=292543&nopa=2&aadredir=1'
}]

function createCuenta(cuenta) {
    const cuentaHTML = `
    <div class="cuenta" id="${cuenta.id}">
      <div class="cuenta-container">
        <div class="cover-image" style="background-image: url('${cuenta.cover}');"></div>
        <div class="content">
          <h1 class="title">${cuenta.title}</h1>
          <h6 class="publisher">${cuenta.publisher}</h6>
        </div>
      </div>
      <a href="${cuenta.download}" target="_blank" class="download ${cuenta.id}"><i class="fal fa-arrow-alt-to-right"></i></a>
    </div>
   `;
    return cuentaHTML;
}

for (const cuenta of arrayCuentas) {
    $('.cuentas').append(createCuenta(cuenta));
}

// initial classes set
const $init = 'fondo';
$('html').addClass($init);
$('.cuenta#' + $init).addClass('active');
$('.cuenta#' + $init).find('.download').addClass('active');
$('.heading').append('¡ Vincula tú cuenta !')

// game card click action
$('.cuenta').click(function() {
    $('html').removeClass();
    $('html').addClass($(this).attr('id'));

    $('.heading').empty();
    $('.heading').append($(this).find('.title').text());

    //   set class active and remove from sibs
    $(this).siblings('.cuenta').removeClass('active');
    $(this).siblings('.cuenta').find('.download').removeClass('active');
    $(this).addClass('active');
    $(this).find('.download').addClass('active');
});

// hover animation
$('.cuenta').hover(function() {
    $(this).addClass('hover');
}, function() {
    $(this).removeClass('hover');
});