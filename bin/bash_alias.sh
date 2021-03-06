#!/usr/bin/env bash

##
# This file is part of gpupo/common
# Created by Gilmar Pupo <contact@gpupo.com>
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
# For more information, see <https://opensource.gpupo.com/>.
##

shopt -s expand_aliases

## System
alias pip='pip3'
alias chown-recursive='chown -R $USER:$(groups | cut -d " " -f1)'
alias chown-recursive-sudo='sudo chown -R $USER:$(groups | cut -d " " -f1)'


## Git
alias gs='git status'
alias gd='git diff'
alias gl='git log'
alias gc='git commit -am'
alias gt='git tag | sort -n'

## Docker
alias dc='docker-compose'
alias dc-up='docker-compose up -d'
alias dc-down='docker-compose down'
alias dc-recreate='docker-compose down; docker-compose up -dV'
alias docker-stop-all='docker stop $(docker ps -a -q)'
alias docker-remove-all='docker rmi $(docker images -a -q)'

## PHP
alias g-composer='php -d memory_limit=-1 `which composer`';

g-composer-require() {
  php -d memory_limit=-1 `which composer` require $1 --no-progress --no-scripts;
}

g-composer-install() {
  php -d memory_limit=-1 `which composer` install --no-progress --no-scripts;
}

g-composer-update() {
  test -f composer.lock && rm -f composer.lock;
  php -d memory_limit=-1 `which composer` update --no-progress --no-scripts;
}

## Docker services
alias php-fpm-service='docker run -v "$PWD":/var/www/app --rm gpupo/container-orchestration:php-dev'
alias php-bash='php-fpm-service bash'

#project ONLY
# alias project-php-fpm-service='dc run --rm php-fpm'
alias project-php-fpm-service='dc exec php-fpm'
alias project-make='project-php-fpm-service make'
alias project-bash='project-php-fpm-service bash'

#Git functions
__gflow_helper_print_with_color()
{
  STARTCOLOR="\e[$2m";
  ENDCOLOR="\e[0m";

  printf "$STARTCOLOR%b$ENDCOLOR" "$1"
}

__gflow_helper_print_style() {
    if [ "$2" == "info" ] ; then
        COLOR="96";
    elif [ "$2" == "success" ] ; then
        COLOR="92";
    elif [ "$2" == "warning" ] ; then
        COLOR="93";
    elif [ "$2" == "danger" ] ; then
        COLOR="91";
    else
        COLOR="0";
    fi

    __gflow_helper_print_with_color "$1 \n" $COLOR
}

gflow-feature-start()
{
  git checkout develop;
  git checkout -b feature/${1};
  git status;
}

gflow-pull-develop() {
    CURRENT=`__gflow_helper_get_branch_name`;
    git checkout develop && \
    git pull --rebase origin develop && \
    git checkout ${CURRENT} && \
    git rebase develop && \
    __gflow_helper_print_style 'All commits from `develop` are here!' 'success';
}

gflow-push-develop() {
    gflow-push-to develop
}

gflow-sync() {
  test -d .git && gflow-pull-develop && gflow-push-develop;
}

gflow-push-to() {
    CURRENT=`__gflow_helper_get_branch_name`
    git checkout $1
    git merge ${CURRENT}
    git push origin $1
    git checkout ${CURRENT};
}

gflow-merge-to() {
    CURRENT=`git-branch-name`
    git checkout $1
    git merge --squash ${CURRENT}
}

gflow-squashing() {
    gflow-pull-develop;

    CURRENT=`__gflow_helper_get_branch_name`
    git checkout develop
    git merge --squash ${CURRENT}
    git commit;
    __gflow_helper_print_style 'Your code is on `develop`' 'success';
    NEWBRANCH="${CURRENT}i";
    git checkout -b ${NEWBRANCH};
    gflow-push-develop;
}

# Hack seguido de Ship
gflow-ship() {
    __gflow_helper_print_style 'Doing hack followed by ship' 'info';
    gflow-pull;
    gflow-push;
    __gflow_helper_print_style 'Done!' 'success';
}

# usage: gflow-absorb https://github.com/foo/common-schema feature-add-test-shipping
gflow-absorb() {
  CURRENT=`__gflow_helper_get_branch_name`
  TEMPORARY=tmp-$2
  git checkout -b $TEMPORARY
  git pull $1 $2;
  git checkout ${CURRENT}
  git merge --squash $TEMPORARY
}

gflow-squash-to-master() {
  CURRENT=`__gflow_helper_get_branch_name`
  git checkout -b "${CURRENT}-`date +"%m-%d-%y-%s"`";
  git checkout -b branchB
  git checkout master
  git checkout -b branchA
  git merge --no-edit -s ours branchB
  git branch branchTEMP
  git reset --hard branchB
  git reset --soft branchTEMP
  git commit --amend -m 'pack to master'
  git checkout master
  git merge --squash branchA
  git commit
  git branch -D  branchA branchB branchTEMP  ${CURRENT}
  git push origin master:master;
}

gflow-tag-delete-everywhere() {
  git tag -d $1 && git push origin :refs/tags/$1;
}

gflow-setPS1() {
  export PS1='\[\033[0;32m\]\u:\[\033[36m\]`_gflow_helper_pwd_shortener`\[\033[0m\]`__gflow_helper_get_branch_name_for_directory`\$ ';
}

__gflow_helper_get_branch_name_for_directory() {
  if [ -d .git ]; then
    printf "($(__gflow_helper_print_with_color `__gflow_helper_get_branch_name` 92))"
  fi;
}

__gflow_helper_get_branch_name() {
  if [ -d .git ]; then
    git branch | grep '\*' | awk '{print $2}'
  fi;
}

_gflow_helper_pwd_shortener() {
    # How many characters of the $PWD should be kept
    local pwdmaxlen=20
    # Indicate that there has been dir truncation
    local trunc_symbol=".."
    local dir=${PWD##*/}
    pwdmaxlen=$(( ( pwdmaxlen < ${#dir} ) ? ${#dir} : pwdmaxlen ))
    NEW_PWD=${PWD/#$HOME/\~}
    local pwdoffset=$(( ${#NEW_PWD} - pwdmaxlen ))
    if [ ${pwdoffset} -gt "0" ]
    then
        NEW_PWD=${NEW_PWD:$pwdoffset:$pwdmaxlen}
        NEW_PWD=${trunc_symbol}/${NEW_PWD#*/}
    fi

    echo $NEW_PWD;
}
