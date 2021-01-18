# Nonces & Security

This addon cares about security. Create a nonce (= number used once) to make sure the action was executed
by a user.

## Example:

Let's say you have the following URL to delete a database entry:
```
https://mywebsite.com/delete.php?id=1234
```

Now others can let you execute this by simply sending you the link or for example as URL of an image, because your
browser tries to load that image by opening that url.
```
<img src="https://mywebsite.com/delete.php?id=1234">
```

To prevent this attacks, you can use nonces. On the page where the user clicks on the "delete" button, you create the
nonce and add it to the target URL. Now your URL can look something like this:
```
https://mywebsite.com/delete.php?id=1234&nonce=nonce_here
```

And, before you actually delete it, check if the passed nonce is correct and, if not, cancel the action.

## How to use the functions

To create a nonce, use:

```
$myNonce = create_nonce('my_secure_token', 'my_action');
```
The action can be anything, but you have to use the same when you verify it. Use for example 'login_user' for login and so on.

Verify it:

```
if(verify_nonce($myNonce, 'my_secure_token', 'my_action')) {
    // Everything OK!
} else {
    // Cancelled, invalid nonce!
}
```

## Important note

The `create_nonce` and `verify_nonce` functions need the `$identifier` argument. We recommend you to create a static token for your project that's secure (just like a password) and use this as identifier, maybe in combination with a user-id. Everybody who knows the action and the identifier can easily create nonces and the whole system is useless.

Every nonce is 6 hours valid.

## create_nonce

```
/**
 * create_nonce
 * @since 1.0
 */
function create_nonce(string $identifier, string $action): string
```

## verify_nonce

```
/**
 * verify_nonce
 * @since 1.0
 */
function verify_nonce(string $nonce, string $identifier, string $action): bool
```