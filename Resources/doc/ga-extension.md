## Google Analytics filters

#### add google campaign information to links in a block



Examples:

```

example from raw html:

# params: source, campaign, medium, content, active
{{ '<a href="test.html">link with anchor</a>'|t4_ga_campaign('source', 'campaign','test') }}

{{ '<a href="test.html">link with anchor</a>'|t4_ga_campaign('source', 'campaign','test', 'top', true) }}

# do not render utm_source attrs etc. this allows to parametrize the rendering
{{ '<a href="test.html">link with anchor</a>'|t4_ga_campaign('source', 'campaign','test', 'top', false) }}

{% gacampaign {utm_source:"email", utm_campaign:"mycampaign"} %}
<a href="test">Test link 1</a>
<p>
<a href="test">Test link 2</a>
</p>
{% endgacampaign %}
   
# do not render utm_source attrs etc. this allows to parametrize the rendering  

{% gacampaign {utm_source:"email", utm_campaign:"mycampaign", active:false} %}
<a href="test">Test link 1</a>
<p>
<a href="test">Test link 2</a>
</p>
{% endgacampaign %}        

```