<?php /* Template Name: CustomPageContact */ ?>
<?php get_header() ?>

    <div class="container-page-contact">
        <div class="map" >
            <div class="nosso-pico">
                <h2>nosso pico</h2>
                <p>Avenida Pedroso de Morais, 2120 - Conjunto 17</p>
                <p>Alto dos Pinheiros - CEP 05419-001</p>
                <p>São Paulo - SP</p>
            </div>

            <iframe
              width="100%"
              height="100%"
              frameborder="0" style="border:0"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.3292224746797!2d-46.70463024980895!3d-23.556616584610097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce57b6c3fd288b%3A0x8e6c358f012a7fa1!2sAv.+Pedroso+de+Morais%2C+2120+-+Pinheiros%2C+S%C3%A3o+Paulo+-+SP%2C+05420-003!5e0!3m2!1spt-BR!2sbr!4v1515690756521" 
              allowfullscreen>
            </iframe>
            
        </div>
        <div class="contact-form">
            <div class="formulario">
                <h1>We love to talk</h1>
                <p>Mande uma mensagem para nós, adoramos trocar experiências</p>
                <?php echo do_shortcode("[contact-form-7 id=\"198\" title=\"We love to talk\"]"); ?>
            </div>
        </div>        
    </div>

<?php get_footer(); ?>