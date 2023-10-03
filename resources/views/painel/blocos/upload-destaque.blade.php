{% set hideBloco = 'hide' %}
{% set tipoArquivo = 'destaque' %}

{% if imgDestaque.arquivo != '' %}
    {% set hideBloco = '' %}
{% endif %}

{{ include('painel/blocos/componentes/imagem.htm') }}