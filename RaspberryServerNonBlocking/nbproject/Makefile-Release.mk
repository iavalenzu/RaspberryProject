#
# Generated Makefile - do not edit!
#
# Edit the Makefile in the project folder instead (../Makefile). Each target
# has a -pre and a -post target defined where you can add customized code.
#
# This makefile implements configuration specific macros and targets.


# Environment
MKDIR=mkdir
CP=cp
GREP=grep
NM=nm
CCADMIN=CCadmin
RANLIB=ranlib
CC=gcc
CCC=g++
CXX=g++
FC=gfortran
AS=as

# Macros
CND_PLATFORM=GNU-MacOSX
CND_DLIB_EXT=dylib
CND_CONF=Release
CND_DISTDIR=dist
CND_BUILDDIR=build

# Include project Makefile
include Makefile

# Object Directory
OBJECTDIR=${CND_BUILDDIR}/${CND_CONF}/${CND_PLATFORM}

# Object Files
OBJECTFILES= \
	${OBJECTDIR}/_ext/441878278/Action.o \
	${OBJECTDIR}/_ext/441878278/ActionAuthenticate.o \
	${OBJECTDIR}/_ext/441878278/ActionExecutor.o \
	${OBJECTDIR}/_ext/441878278/ActionFactory.o \
	${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter.o \
	${OBJECTDIR}/_ext/441878278/ConnectionSSL.o \
	${OBJECTDIR}/_ext/441878278/DatabaseAdapter.o \
	${OBJECTDIR}/_ext/441878278/DatabaseModel.o \
	${OBJECTDIR}/_ext/441878278/DatabaseSource.o \
	${OBJECTDIR}/_ext/441878278/DeviceModel.o \
	${OBJECTDIR}/_ext/441878278/IncomingAction.o \
	${OBJECTDIR}/_ext/441878278/IncomingActionExecutor.o \
	${OBJECTDIR}/_ext/441878278/IncomingActionFactory.o \
	${OBJECTDIR}/_ext/441878278/JSONBuffer.o \
	${OBJECTDIR}/_ext/441878278/Notification.o \
	${OBJECTDIR}/_ext/441878278/ServerSSL.o \
	${OBJECTDIR}/_ext/441878278/Utilities.o \
	${OBJECTDIR}/_ext/856698395/JSONAllocator.o \
	${OBJECTDIR}/_ext/856698395/JSONChildren.o \
	${OBJECTDIR}/_ext/856698395/JSONDebug.o \
	${OBJECTDIR}/_ext/856698395/JSONIterators.o \
	${OBJECTDIR}/_ext/856698395/JSONMemory.o \
	${OBJECTDIR}/_ext/856698395/JSONNode.o \
	${OBJECTDIR}/_ext/856698395/JSONNode_Mutex.o \
	${OBJECTDIR}/_ext/856698395/JSONPreparse.o \
	${OBJECTDIR}/_ext/856698395/JSONStream.o \
	${OBJECTDIR}/_ext/856698395/JSONValidator.o \
	${OBJECTDIR}/_ext/856698395/JSONWorker.o \
	${OBJECTDIR}/_ext/856698395/JSONWriter.o \
	${OBJECTDIR}/_ext/856698395/internalJSONNode.o \
	${OBJECTDIR}/_ext/856698395/libjson.o \
	${OBJECTDIR}/main.o

# Test Directory
TESTDIR=${CND_BUILDDIR}/${CND_CONF}/${CND_PLATFORM}/tests

# Test Files
TESTFILES= \
	${TESTDIR}/TestFiles/f1

# C Compiler Flags
CFLAGS=

# CC Compiler Flags
CCFLAGS=
CXXFLAGS=

# Fortran Compiler Flags
FFLAGS=

# Assembler Flags
ASFLAGS=

# Link Libraries and Options
LDLIBSOPTIONS=

# Build Targets
.build-conf: ${BUILD_SUBPROJECTS}
	"${MAKE}"  -f nbproject/Makefile-${CND_CONF}.mk ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryservernonblocking

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryservernonblocking: ${OBJECTFILES}
	${MKDIR} -p ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}
	${LINK.cc} -o ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryservernonblocking ${OBJECTFILES} ${LDLIBSOPTIONS}

${OBJECTDIR}/_ext/441878278/Action.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Action.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/Action.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Action.cpp

${OBJECTDIR}/_ext/441878278/ActionAuthenticate.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionAuthenticate.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionAuthenticate.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionAuthenticate.cpp

${OBJECTDIR}/_ext/441878278/ActionExecutor.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionExecutor.cpp

${OBJECTDIR}/_ext/441878278/ActionFactory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionFactory.cpp

${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionResponsePinMeter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionResponsePinMeter.cpp

${OBJECTDIR}/_ext/441878278/ConnectionSSL.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ConnectionSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ConnectionSSL.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ConnectionSSL.cpp

${OBJECTDIR}/_ext/441878278/DatabaseAdapter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseAdapter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DatabaseAdapter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseAdapter.cpp

${OBJECTDIR}/_ext/441878278/DatabaseModel.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseModel.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DatabaseModel.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseModel.cpp

${OBJECTDIR}/_ext/441878278/DatabaseSource.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseSource.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DatabaseSource.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseSource.cpp

${OBJECTDIR}/_ext/441878278/DeviceModel.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DeviceModel.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DeviceModel.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DeviceModel.cpp

${OBJECTDIR}/_ext/441878278/IncomingAction.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingAction.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/IncomingAction.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingAction.cpp

${OBJECTDIR}/_ext/441878278/IncomingActionExecutor.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/IncomingActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionExecutor.cpp

${OBJECTDIR}/_ext/441878278/IncomingActionFactory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/IncomingActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionFactory.cpp

${OBJECTDIR}/_ext/441878278/JSONBuffer.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/JSONBuffer.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/JSONBuffer.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/JSONBuffer.cpp

${OBJECTDIR}/_ext/441878278/Notification.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Notification.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/Notification.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Notification.cpp

${OBJECTDIR}/_ext/441878278/ServerSSL.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ServerSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ServerSSL.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ServerSSL.cpp

${OBJECTDIR}/_ext/441878278/Utilities.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Utilities.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/Utilities.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Utilities.cpp

${OBJECTDIR}/_ext/856698395/JSONAllocator.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONAllocator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONAllocator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONAllocator.cpp

${OBJECTDIR}/_ext/856698395/JSONChildren.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONChildren.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONChildren.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONChildren.cpp

${OBJECTDIR}/_ext/856698395/JSONDebug.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONDebug.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONDebug.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONDebug.cpp

${OBJECTDIR}/_ext/856698395/JSONIterators.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONIterators.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONIterators.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONIterators.cpp

${OBJECTDIR}/_ext/856698395/JSONMemory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONMemory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONMemory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONMemory.cpp

${OBJECTDIR}/_ext/856698395/JSONNode.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode.cpp

${OBJECTDIR}/_ext/856698395/JSONNode_Mutex.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode_Mutex.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONNode_Mutex.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode_Mutex.cpp

${OBJECTDIR}/_ext/856698395/JSONPreparse.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONPreparse.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONPreparse.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONPreparse.cpp

${OBJECTDIR}/_ext/856698395/JSONStream.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONStream.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONStream.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONStream.cpp

${OBJECTDIR}/_ext/856698395/JSONValidator.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONValidator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONValidator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONValidator.cpp

${OBJECTDIR}/_ext/856698395/JSONWorker.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWorker.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONWorker.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWorker.cpp

${OBJECTDIR}/_ext/856698395/JSONWriter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWriter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONWriter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWriter.cpp

${OBJECTDIR}/_ext/856698395/internalJSONNode.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/internalJSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/internalJSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/internalJSONNode.cpp

${OBJECTDIR}/_ext/856698395/libjson.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/libjson.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/libjson.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/libjson.cpp

${OBJECTDIR}/main.o: main.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -O2 -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/main.o main.cpp

# Subprojects
.build-subprojects:

# Build Test Targets
.build-tests-conf: .build-conf ${TESTFILES}
${TESTDIR}/TestFiles/f1: ${TESTDIR}/_ext/776693964/databasemodelclass.o ${TESTDIR}/_ext/776693964/newtestrunner.o ${OBJECTFILES:%.o=%_nomain.o}
	${MKDIR} -p ${TESTDIR}/TestFiles
	${LINK.cc}   -o ${TESTDIR}/TestFiles/f1 $^ ${LDLIBSOPTIONS} `cppunit-config --libs`   


${TESTDIR}/_ext/776693964/databasemodelclass.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/tests/databasemodelclass.cpp 
	${MKDIR} -p ${TESTDIR}/_ext/776693964
	${RM} "$@.d"
	$(COMPILE.cc) -O2 `cppunit-config --cflags` -MMD -MP -MF "$@.d" -o ${TESTDIR}/_ext/776693964/databasemodelclass.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/tests/databasemodelclass.cpp


${TESTDIR}/_ext/776693964/newtestrunner.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/tests/newtestrunner.cpp 
	${MKDIR} -p ${TESTDIR}/_ext/776693964
	${RM} "$@.d"
	$(COMPILE.cc) -O2 `cppunit-config --cflags` -MMD -MP -MF "$@.d" -o ${TESTDIR}/_ext/776693964/newtestrunner.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/tests/newtestrunner.cpp


${OBJECTDIR}/_ext/441878278/Action_nomain.o: ${OBJECTDIR}/_ext/441878278/Action.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Action.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/Action.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/Action_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Action.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/Action.o ${OBJECTDIR}/_ext/441878278/Action_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/ActionAuthenticate_nomain.o: ${OBJECTDIR}/_ext/441878278/ActionAuthenticate.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionAuthenticate.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/ActionAuthenticate.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionAuthenticate_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionAuthenticate.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/ActionAuthenticate.o ${OBJECTDIR}/_ext/441878278/ActionAuthenticate_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/ActionExecutor_nomain.o: ${OBJECTDIR}/_ext/441878278/ActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/ActionExecutor.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionExecutor_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionExecutor.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/ActionExecutor.o ${OBJECTDIR}/_ext/441878278/ActionExecutor_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/ActionFactory_nomain.o: ${OBJECTDIR}/_ext/441878278/ActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/ActionFactory.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionFactory_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionFactory.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/ActionFactory.o ${OBJECTDIR}/_ext/441878278/ActionFactory_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter_nomain.o: ${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionResponsePinMeter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ActionResponsePinMeter.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter.o ${OBJECTDIR}/_ext/441878278/ActionResponsePinMeter_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/ConnectionSSL_nomain.o: ${OBJECTDIR}/_ext/441878278/ConnectionSSL.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ConnectionSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/ConnectionSSL.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ConnectionSSL_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ConnectionSSL.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/ConnectionSSL.o ${OBJECTDIR}/_ext/441878278/ConnectionSSL_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/DatabaseAdapter_nomain.o: ${OBJECTDIR}/_ext/441878278/DatabaseAdapter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseAdapter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/DatabaseAdapter.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DatabaseAdapter_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseAdapter.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/DatabaseAdapter.o ${OBJECTDIR}/_ext/441878278/DatabaseAdapter_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/DatabaseModel_nomain.o: ${OBJECTDIR}/_ext/441878278/DatabaseModel.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseModel.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/DatabaseModel.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DatabaseModel_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseModel.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/DatabaseModel.o ${OBJECTDIR}/_ext/441878278/DatabaseModel_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/DatabaseSource_nomain.o: ${OBJECTDIR}/_ext/441878278/DatabaseSource.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseSource.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/DatabaseSource.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DatabaseSource_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DatabaseSource.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/DatabaseSource.o ${OBJECTDIR}/_ext/441878278/DatabaseSource_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/DeviceModel_nomain.o: ${OBJECTDIR}/_ext/441878278/DeviceModel.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DeviceModel.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/DeviceModel.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/DeviceModel_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/DeviceModel.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/DeviceModel.o ${OBJECTDIR}/_ext/441878278/DeviceModel_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/IncomingAction_nomain.o: ${OBJECTDIR}/_ext/441878278/IncomingAction.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingAction.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/IncomingAction.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/IncomingAction_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingAction.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/IncomingAction.o ${OBJECTDIR}/_ext/441878278/IncomingAction_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/IncomingActionExecutor_nomain.o: ${OBJECTDIR}/_ext/441878278/IncomingActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/IncomingActionExecutor.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/IncomingActionExecutor_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionExecutor.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/IncomingActionExecutor.o ${OBJECTDIR}/_ext/441878278/IncomingActionExecutor_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/IncomingActionFactory_nomain.o: ${OBJECTDIR}/_ext/441878278/IncomingActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/IncomingActionFactory.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/IncomingActionFactory_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/IncomingActionFactory.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/IncomingActionFactory.o ${OBJECTDIR}/_ext/441878278/IncomingActionFactory_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/JSONBuffer_nomain.o: ${OBJECTDIR}/_ext/441878278/JSONBuffer.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/JSONBuffer.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/JSONBuffer.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/JSONBuffer_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/JSONBuffer.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/JSONBuffer.o ${OBJECTDIR}/_ext/441878278/JSONBuffer_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/Notification_nomain.o: ${OBJECTDIR}/_ext/441878278/Notification.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Notification.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/Notification.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/Notification_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Notification.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/Notification.o ${OBJECTDIR}/_ext/441878278/Notification_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/ServerSSL_nomain.o: ${OBJECTDIR}/_ext/441878278/ServerSSL.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ServerSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/ServerSSL.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/ServerSSL_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/ServerSSL.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/ServerSSL.o ${OBJECTDIR}/_ext/441878278/ServerSSL_nomain.o;\
	fi

${OBJECTDIR}/_ext/441878278/Utilities_nomain.o: ${OBJECTDIR}/_ext/441878278/Utilities.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Utilities.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/441878278
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/441878278/Utilities.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/441878278/Utilities_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/Utilities.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/441878278/Utilities.o ${OBJECTDIR}/_ext/441878278/Utilities_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONAllocator_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONAllocator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONAllocator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONAllocator.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONAllocator_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONAllocator.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONAllocator.o ${OBJECTDIR}/_ext/856698395/JSONAllocator_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONChildren_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONChildren.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONChildren.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONChildren.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONChildren_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONChildren.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONChildren.o ${OBJECTDIR}/_ext/856698395/JSONChildren_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONDebug_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONDebug.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONDebug.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONDebug.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONDebug_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONDebug.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONDebug.o ${OBJECTDIR}/_ext/856698395/JSONDebug_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONIterators_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONIterators.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONIterators.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONIterators.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONIterators_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONIterators.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONIterators.o ${OBJECTDIR}/_ext/856698395/JSONIterators_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONMemory_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONMemory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONMemory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONMemory.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONMemory_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONMemory.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONMemory.o ${OBJECTDIR}/_ext/856698395/JSONMemory_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONNode_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONNode.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONNode_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONNode.o ${OBJECTDIR}/_ext/856698395/JSONNode_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONNode_Mutex_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONNode_Mutex.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode_Mutex.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONNode_Mutex.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONNode_Mutex_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONNode_Mutex.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONNode_Mutex.o ${OBJECTDIR}/_ext/856698395/JSONNode_Mutex_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONPreparse_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONPreparse.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONPreparse.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONPreparse.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONPreparse_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONPreparse.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONPreparse.o ${OBJECTDIR}/_ext/856698395/JSONPreparse_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONStream_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONStream.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONStream.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONStream.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONStream_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONStream.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONStream.o ${OBJECTDIR}/_ext/856698395/JSONStream_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONValidator_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONValidator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONValidator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONValidator.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONValidator_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONValidator.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONValidator.o ${OBJECTDIR}/_ext/856698395/JSONValidator_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONWorker_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONWorker.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWorker.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONWorker.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONWorker_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWorker.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONWorker.o ${OBJECTDIR}/_ext/856698395/JSONWorker_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/JSONWriter_nomain.o: ${OBJECTDIR}/_ext/856698395/JSONWriter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWriter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/JSONWriter.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/JSONWriter_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/JSONWriter.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/JSONWriter.o ${OBJECTDIR}/_ext/856698395/JSONWriter_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/internalJSONNode_nomain.o: ${OBJECTDIR}/_ext/856698395/internalJSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/internalJSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/internalJSONNode.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/internalJSONNode_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/internalJSONNode.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/internalJSONNode.o ${OBJECTDIR}/_ext/856698395/internalJSONNode_nomain.o;\
	fi

${OBJECTDIR}/_ext/856698395/libjson_nomain.o: ${OBJECTDIR}/_ext/856698395/libjson.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/libjson.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/856698395
	@NMOUTPUT=`${NM} ${OBJECTDIR}/_ext/856698395/libjson.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/856698395/libjson_nomain.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/libjson/_internal/Source/libjson.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/_ext/856698395/libjson.o ${OBJECTDIR}/_ext/856698395/libjson_nomain.o;\
	fi

${OBJECTDIR}/main_nomain.o: ${OBJECTDIR}/main.o main.cpp 
	${MKDIR} -p ${OBJECTDIR}
	@NMOUTPUT=`${NM} ${OBJECTDIR}/main.o`; \
	if (echo "$$NMOUTPUT" | ${GREP} '|main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T main$$') || \
	   (echo "$$NMOUTPUT" | ${GREP} 'T _main$$'); \
	then  \
	    ${RM} "$@.d";\
	    $(COMPILE.cc) -O2 -Dmain=__nomain -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/main_nomain.o main.cpp;\
	else  \
	    ${CP} ${OBJECTDIR}/main.o ${OBJECTDIR}/main_nomain.o;\
	fi

# Run Test Targets
.test-conf:
	@if [ "${TEST}" = "" ]; \
	then  \
	    ${TESTDIR}/TestFiles/f1 || true; \
	else  \
	    ./${TEST} || true; \
	fi

# Clean Targets
.clean-conf: ${CLEAN_SUBPROJECTS}
	${RM} -r ${CND_BUILDDIR}/${CND_CONF}
	${RM} ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryservernonblocking

# Subprojects
.clean-subprojects:

# Enable dependency checking
.dep.inc: .depcheck-impl

include .dep.inc
