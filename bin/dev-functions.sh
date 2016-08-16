#!/bin/bash
# @Date:   2016-08-11T08:52:08-03:00
# @Modified at 2016-08-11T08:52:08-03:00
# {release_id}

PW=`pwd`;
declare -a arr=("src" "tests" "module" "app" "includes")
for i in "${arr[@]}"
do
   if [ -d "${PW}/$i" ]; then
     echo $i;
     pushd $i;
     phpcbf --standard=PSR2 ./;
     popd;
   fi
done

php-cs-fixer fix .;
