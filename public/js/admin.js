$(document).ready(function () {

    //sidebar trigger
    $('.ui.sidebar')
    .sidebar('setting', 'transition', 'overlay')
    .sidebar('attach events', '.open.button', 'show')

    // .sidebar('toggle')
    ;

    $('.menu .item')
        .tab()
    ;


    $('.accordion')
      .accordion({
        transition: 'drop'
      })
    ;
    $('.poptop')
      .popup({
        inline: true
      })
    ;

    $('.dropdown')
      .dropdown({
        // you can use any ui transition
        transition: 'drop'
      })
    ;

      $('.ui.embed').embed();
});
