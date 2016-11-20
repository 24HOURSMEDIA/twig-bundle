## Google Analytics filters

#### add google campaign information to links in a block



Examples:

```
{{ '<a href="test.html">link with anchor</a>'|t4_ga_campaign('source', 'campaign','test') }}

{% gacampaign {utm_source:"email", utm_campaign:"mycampaign"} %}
<a href="test">Test link 1</a>
<p>
<a href="test">Test link 2</a>
</p>
{% endgacampaign %}
        

```