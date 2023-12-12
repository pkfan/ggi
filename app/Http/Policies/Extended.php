<?php 

namespace App\Http\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class Extended extends Basic{

    public function configure(){
        
        parent::configure();
        $this->addDirective(Directive::STYLE ,'unpkg.com/aos@next/dist/aos.css');
        $this->addDirective(Directive::STYLE, 'fonts.gstatic.com');
        $this->addDirective(Directive::STYLE ,'cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css');
        $this->addDirective(Directive::STYLE ,'recovery.taheiya.sa/landing_page/lib/owlcarousel/assets/owl.carousel.min.css');
        $this->addDirective(Directive::STYLE ,'recovery.taheiya.sa/landing_page/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css');
        $this->addDirective(Directive::STYLE ,'recovery.taheiya.sa/landing_page/css/bootstrap.min.css');
        $this->addDirective(Directive::STYLE ,'recovery.taheiya.sa/landing_page/css/style.css');
         
         
        $this->addDirective(Directive::STYLE ,'fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap');
        $this->addDirective(Directive::SCRIPT ,'code.jquery.com/jquery-3.6.0.min.js');
        $this->addDirective(Directive::SCRIPT ,'stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js');
        $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/easing/easing.min.js');
        $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/waypoints/waypoints.min.js');
        $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/owlcarousel/owl.carousel.min.js'); 
        $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/tempusdominus/js/moment.min.js');
        $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/tempusdominus/js/moment-timezone.min.js');
        $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js');
         $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/js/main.js');
         $this->addDirective(Directive::SCRIPT ,'https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js');
         $this->addDirective(Directive::SCRIPT ,'unpkg.com/aos@next/dist/aos.js');
        // $this->addDirective(Directive::SCRIPT ,'recovery.taheiya.sa/landing_page/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js');
   
    }

}