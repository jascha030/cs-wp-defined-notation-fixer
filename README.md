# Custom PHP CS Fixer for WordPress

Fixes any notation of the check if `ABSPATH` is defined to my preferred notation.

**Warning** The following is based on personal preference and does not follow "WordPress coding standards"

**Wrong**

```php
<?php
if (! defined('ABSPATH')) die();
```

**Wrong**

```php
<?php
! defined('ABSPATH') && exit();
```

**Wrong**

```php
<?php
if (! defined('ABSPATH')) {
    exit('Forbidden');
}
```

### Good!

```php
<?php

// Clear, concise. 
defined('ABSPATH') || exit('Forbidden.');
```