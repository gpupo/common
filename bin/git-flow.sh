#!/bin/bash

print_with_color()
{
  # @see https://misc.flogisoft.com/bash/tip_colors_and_formatting
  STARTCOLOR="\e[$2m";
  ENDCOLOR="\e[0m";

  printf "$STARTCOLOR%b$ENDCOLOR" "$1"
}

print_style() {
    if [ "$2" == "info" ] ; then
        COLOR="96";
    elif [ "$2" == "success" ] ; then
        COLOR="92";
    elif [ "$2" == "warning" ] ; then
        COLOR="93";
    elif [ "$2" == "danger" ] ; then
        COLOR="91";
    else #default color
        COLOR="0";
    fi

    print_with_color "$1 \n" $COLOR
}

git-flow-pull() {
    CURRENT=`git-branch-name`
    git checkout develop
    git pull --rebase origin develop
    git checkout ${CURRENT}
    git rebase develop;
    print_style 'All commits from `develop` are here!' 'success';
    git branch;
}

git-flow-push() {
    git-flow-push-to develop
}

git-flow-master() {
    git-flow-push-to master
}

git-flow-push-to() {
    CURRENT=`git-branch-name`
    git checkout $1
    git merge ${CURRENT}
    git push origin $1
    git checkout ${CURRENT};
}

git-flow-push-squash() {
    CURRENT=`git-branch-name`
    git checkout develop
    git merge --squash ${CURRENT}
    git commit
    git push origin develop
    print_style 'Your code is on `develop`' 'success';
    print_style 'Now, start a new `feature-*` branch' 'warning';
    echo -n "Type the new branch name (ex:feature-HUMM234):";
    read NEWBRANCH;
    git checkout -b ${NEWBRANCH};
    print_style 'Find the Beauty in Code!' 'success';
    git branch;
}

# Hack seguido de Ship
git-flow-ship() {
    print_style 'Doing hack followed by ship' 'info';
    git-flow-pull;
    git-flow-push;
    print_style 'Done!' 'success';
}

# usage: git-flow-absorb https://github.com/foo/common-schema feature-add-test-shipping
git-flow-absorb() {
  CURRENT=`git-branch-name`
  TEMPORARY=tmp-$2
  git checkout -b $TEMPORARY
  git pull $1 $2;
  git checkout ${CURRENT}
  git merge --squash $TEMPORARY
}

git-merge-to-master() {
  CURRENT=`git-branch-name`
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
  git checkout -b ${CURRENT}
}

git-branch-name() {
  if [ -d .git ]; then
    git branch | grep '\*' | awk '{print $2}'
  fi;
}

export PS1="\[\$(print_with_color \u 92)\$(print_with_color @ 90)\$(print_with_color \w 94)\$(print_with_color : 90)\$(print_with_color \$(git-branch-name) 96)\]\$(print_with_color \$ 90) "
