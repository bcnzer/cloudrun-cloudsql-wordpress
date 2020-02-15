# Variables used in this script. Change anything with a value of <TODO>
PROJECT_NAME=<TODO> # Your project name. You can see it in the URL of the portal i.e. https://console.cloud.google.com/run?project=my-cr-project&folder=&organizationId= then the project is "my-cr-project"
CLOUDSQL_INSTANCE=wp-mysql # This is the instance name - sorta like the MySQL install which can then have many databases in it. You're welcome to change it
CLOUDSQL_TIER=db-f1-micro # I'm using the smallest MySQL instance. A full list is available here: https://cloud.google.com/sql/pricing#2nd-gen-pricing
DBNAME=wordpress # The actual database. You're welcome to call it something different
CLOUDSQL_TIER=db-f1-micro # I'm using the smallest MySQL instance. A full list is available here: https://cloud.google.com/sql/pricing#2nd-gen-pricing
ROOT_PSWD=<TODO> # Enter a root password of your choice. Something strong!
DB_USER=wordpress # You're welcome to change this if you like
USER_PSWD=<TODO> # For the "wordpress" user, enter a password of your choice. Something strong!
REGION=us-central1 # Feel free to set this to wahtever you like BUT be aware that, as of this writing, Cloud Run is not available everywhere. Full list of regions is here: https://cloud.google.com/compute/docs/regions-zones
ZONE=us-central1-a # Once again, set it to whatever you like. See above link for the available zones
CLOUDSQL_INSTANCE_CONNECTION_NAME="$PROJECT_NAME:$REGION:$CLOUDSQL_INSTANCE" # The specific instance name we need later on

# Setup basic config
gcloud config set core/project $PROJECT_NAME
gcloud config set compute/region $REGION
gcloud config set compute/zone $ZONE

# Create a minimal (micro) MySQL instance
gcloud sql instances create $CLOUDSQL_INSTANCE --tier=$CLOUDSQL_TIER --region=us-central1
gcloud sql users set-password root --host % --instance $CLOUDSQL_INSTANCE --password $ROOT_PSWD

# Create a database called "wordpress" and create a user account
gcloud sql databases create $DBNAME --instance=$CLOUDSQL_INSTANCE --charset=utf8 --collation=utf8_general_ci
gcloud sql users create $DB_USER --host=% --instance=$CLOUDSQL_INSTANCE --password=$USER_PSWD


# Delete the existing wordpress Cloud Run instance, if it exists. I added this while I was testing.
# gcloud run services delete wordpress --platform managed --quiet

# Build your first WordPress image and submit it to GCP Container Repository. Note this is explictly tagged as v1
gcloud builds submit --tag gcr.io/$PROJECT_NAME/wordpress:v1

# Using that
gcloud run deploy wordpress --image gcr.io/$PROJECT_NAME/wordpress:v1 \
--add-cloudsql-instances $CLOUDSQL_INSTANCE \
--update-env-vars DB_HOST='127.0.0.1',DB_NAME=$DBNAME,DB_USER=$DB_USER,DB_PASSWORD=$USER_PSWD,CLOUDSQL_INSTANCE=$CLOUDSQL_INSTANCE_CONNECTION_NAME \
--platform=managed
