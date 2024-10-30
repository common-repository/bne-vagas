<div class="wrap">
<h1><?php echo __("Configurações BNE") ?></h1>
<form method="post" action="options.php"> 
    <?php echo settings_fields( 'bne_url_options' ); ?>
    <?php echo do_settings_sections( 'bne_url_options' ); ?>

    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php echo _("URL do resultado da pesquisa de vagas") ?></th>
            <td>
                <code><?php echo esc_html(get_home_url()) ?></code>
                <input name="<?php echo esc_html(BNE_Strings::JOB_SEARCH_RESULT_URL_OPTION_NAME) ?>"  
                    value="<?php echo esc_html(get_option( BNE_Strings::JOB_SEARCH_RESULT_URL_OPTION_NAME )) ?>"
                    type="text" 
                    class="regular-text code">
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php echo _("Número de vagas por página") ?></th>
            <td>
                <input name="<?php echo esc_html(BNE_Strings::JOB_SEARCH_RESULTS_PER_PAGE_OPTION_NAME) ?>"  
                    value="<?php echo esc_html(get_option( BNE_Strings::JOB_SEARCH_RESULTS_PER_PAGE_OPTION_NAME )) ?>"
                    type="number" 
                    class="regular-text code">
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php echo _("Página do resultado de vagas") ?></th>
            <td>
                <?php wp_dropdown_pages(array(
                    'selected'  => esc_html(get_option( BNE_Strings::JOB_SEARCH_RESULT_PAGE_ID_OPTION_NAME )),
                    'name'      => esc_html(BNE_Strings::JOB_SEARCH_RESULT_PAGE_ID_OPTION_NAME) ,
                    'class'     => "regular-text code"
                )); ?>
                <p class="description" id="tagline-description"><?php echo __("Selecione a página a ser utilizada para a exibição do resultado de vagas. O shortcode [". BNE_Strings::JOB_SEARCH_RESULTS_SHORTCODE_NAME ."] deve estar presente nesta página para que o resultado seja exibido.") ?></p>            
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>
</form>
</div>
