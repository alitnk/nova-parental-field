# Nova Parental Field
A Laravel Nova field made for [Parental](https://github.com/calebporzio/parental) to quickly make a select element to choose the child type

## Installation

```bash
composer require wamadev/nova-parental-field
```

## Usage

```php
use Wama\NovaParentalField\Parental;

 public function fields(Request $request)
    {
        return [
            // ... your other fields
            
            Parental::make()->searchable(),
        ];
    }
```
The parental field extends Nova's select field. so you can make use of methods like `searchable()` on it.

Passing the field's name is optional, the package will automatically get the field name based on your `$childColumn` property and if there is none, [it'll just default to `type`](https://github.com/calebporzio/parental/blob/a0739736b9a34cb78bca5b4eda45882765644ff5/src/HasChildren.php#L174).

After making the field, it automatically gets the children types and populates them in the select field.

---

So, assuming your parent model looks like this:
```php
class User extends Model {
    use HasChildren;

    private $childTypes = [
        'admin' => Admin::class,
        'moderator' => Moderator::class,
        'author' => Author::class,
    ];
}
```
After you add the `Parental::make()->searchable()` to your Nova fields, you should get the following result:

![nova-parental-field-1](https://user-images.githubusercontent.com/35243344/124952789-c6e35400-e029-11eb-9942-e5e080fe3a34.jpg)
