## validator extension

This extension applies the symfony validator to some data, and returns the human readable errors as an array.

```

{% set errors = item|t4_validate %}
Validation errors: {{ errors|length }}

<ul>
{% for error in errors %}
<li>{{ error }}</li>
    {% endfor %}
</ul>
        
```