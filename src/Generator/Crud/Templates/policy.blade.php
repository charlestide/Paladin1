
namespace Charlestide\Paladin\Policies;

use Charlestide\Paladin\Models\{{$ModelName}};

class {{$ModelName}}Policy extends CrudPolicy
{
    protected $defaultObjectClass = {{$ModelName}}::class;
}
