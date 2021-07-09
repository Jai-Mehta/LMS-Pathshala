import boto3
from boto3.dynamodb.conditions import Key, Attr

# Get the service resource.
dynamodb = boto3.resource('dynamodb')


table = dynamodb.Table('users')


#response = table.get_item(
#    Key={
#        'username': 'janedoe',
#        'last_name': 'Doe'
#    }
#)


response = table.query(
    KeyConditionExpression=Key('sensorid').eq('1')
)

return response


